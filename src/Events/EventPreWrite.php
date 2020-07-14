<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Payment;
use App\Entity\Property;
use App\Entity\Realty;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EventPreWrite
{
    public function __construct(){

    }

    /**
     * @return array[]
     */
    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW =>['generateReference', EventPriorities::PRE_WRITE]
        ];
    }

    /**
     * @param ViewEvent $event
     * @throws \Exception
     */
    public function generateReference(ViewEvent $event){
        $data = $event->getControllerResult();
        $method = $event->getRequest()->getMethod(); //POST PUT GET DELETE
        if($method==='POST'){
            if($data instanceof Reservation){
                $reference = 'RES-'.bin2hex(random_bytes(2));
                $data->setReference($reference);
            }

            if($data instanceof Payment){
                $reference = 'PAY-'.bin2hex(random_bytes(2));
                $data->setReference($reference);
            }

            if($data instanceof Property){
                $reference = 'PPT-'.bin2hex(random_bytes(2));
                $data->setReference($reference);
            }

            if($data instanceof Realty){
                $reference = 'RLT-'.bin2hex(random_bytes(2));
                $data->setReference($reference);
            }
        }

    }


}