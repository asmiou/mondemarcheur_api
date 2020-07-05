<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserData extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $e){
        $this->encoder = $e;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        for($i=0; $i<30; $i++){
            $user = new User();
            $pass = $this->encoder->encodePassword($user, 'password');
            //$g = ($i%3)?'f':'m';
            $g = 'm';
            //$a = ($i%5)?false:true;
            $a = true;
            $user->setAddress($faker->address)
                ->setBirthday($faker->dateTime)
                ->setCity($faker->city)
                ->setCountry($faker->country)
                ->setEmail($faker->email)
                ->setPassword($pass)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setGender($faker->randomElement(['f','m']))
                ->setIsEnabled($faker->randomElement([true, false]))
                ->setLogin($faker->userName)
                ->setPhone($faker->phoneNumber)
                ->setRoles(['ROLE_ADMIN','ROLE_USER'])
                ->setZip($faker->postcode)
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }
}
