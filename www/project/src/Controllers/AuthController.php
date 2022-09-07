<?php
namespace Controllers;

use Core\Prototype\Request;

class AuthController
{
    #[Route(name: 'login', path: '/login', methods: ['POST'])]
    public function login(Request $request)
    {

    }

    #[Route(name: 'logout', path: '/logout', methods: ['GET'])]
    public function logout(Request $request)
    {

    }
}