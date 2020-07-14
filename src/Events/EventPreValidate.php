<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Company;
use App\Entity\Reservation;
use App\Entity\Status;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class EventPreValidate
{
    private $security;
    public function __construct(Security $sec){
        $this->security = $sec;
    }

    /**
     * @return array[]
     */
    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW =>['generateReference', EventPriorities::PRE_VALIDATE]
        ];
    }

    public  function setUser( ViewEvent $event){
        $data = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        $user = $this->security->getUser();
        if($method==='POST'){
            if($data instanceof Reservation){
                $data->setCustomer($user);
            }

            if($data instanceof Company){
                $data->setOwner($user);
            }

            if($data instanceof Status){
                $data->setUser($user);
            }
        }

    }


}