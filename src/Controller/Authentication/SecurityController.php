<?php

namespace App\Controller\Authentication;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {

    }
}