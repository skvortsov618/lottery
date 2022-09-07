<?php

namespace Core\Authenticators;

use Core\Prototype\Security\AuthenticatorInterface;
use Core\Prototype\Route;
use Core\Prototype\Request;

class JSONAuth implements AuthenticatorInterface
{
    protected Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function supports() {
        if ($this->request->getPath() === '/login' && $this->request->getMethod() === 'POST') return true;
        return false;
    }

    public function authorize() {
        $login = $request->get('login');
        $password = $request->get('password');
        return ['id' => 1, 'name' => 'john', 'role' => 'admin'];
    }

    public function onFailure() {
        throw new \Exception('Failed to authorize');
    }

    public function onSuccess() {
        return;
    }
}