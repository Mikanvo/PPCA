<?php

namespace GDL\UtilisateurBundle\EventListener;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class SecurityListener
{

   public function __construct(SecurityContextInterface $security, Session $session)
   {
      $this->security = $security;
      $this->session = $session;
   }

   public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
   {
        $token = $event->getAuthenticationToken();
        $token->setAttribute('laboratoire', $token->getUser()->getEmploye()->getLaboratoire());
        $token->setAttribute('exercice', date('Y'));
        
        $this->session->set('labloratoire', $token->getUser()->getEmploye()->getLaboratoire());
        $this->session->set('exercice', date('Y'));
   }

}