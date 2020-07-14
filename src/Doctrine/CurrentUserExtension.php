<?php


namespace App\Doctrine;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Company;
use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class CurrentUserExtension implements  QueryCollectionExtensionInterface, QueryItemExtensionInterface {
    private $security;
    private $auth;

    public function __construct(Security $sec, AuthorizationCheckerInterface $a){
        $this->security = $sec;
        $this->auth = $a;
    }


    public function applyToCollection(QueryBuilder $queryBuilder,
                                      QueryNameGeneratorInterface $queryNameGenerator,
                                      string $resourceClass, string $operationName = null)
    {
        $this->addUseOnQuery($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder,
                                QueryNameGeneratorInterface $queryNameGenerator,
                                string $resourceClass, array $identifiers,
                                string $operationName = null, array $context = [])
    {
        $this->addUseOnQuery($queryBuilder, $resourceClass);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $resourceClass
     */
    public function addUseOnQuery(QueryBuilder $queryBuilder, string $resourceClass){
        //On recupère l'utilisateur connecté
        $user = $this->security->getUser();
        if($user instanceof User){
            $this->addWhere($queryBuilder, $resourceClass, $user);
        }
    }

    /**
     * On ajoute la condition where
     * @param QueryBuilder $queryBuilder
     * @param string $resourceClass
     * @param User $user
     */
    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass, User $user){
        // il faut chaupper l'alias utilisé
        $alias = $queryBuilder->getRootAliases()[0];

        //Si c'est une requête concernant un client
        if($resourceClass === Reservation::class && !$this->auth->isGranted('ROLE_ADMIN')){
            $queryBuilder
                ->andWhere("$alias.customer = :user")
                ->setParameter('user', $user);
        }

        //Si c'est une requête concernant une facture
        if($resourceClass === Company::class && !$this->auth->isGranted('ROLE_ADMIN')){
            $queryBuilder
                ->join("$alias.owner", "c")
                ->andWhere("c.owner = :user")
                ->setParameter('user', $user);
        }
    }
}