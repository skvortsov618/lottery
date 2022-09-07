<?php
namespace Core\Authenticators;

use Core\Prototype\Security\AuthenticatorInterface;
use Core\Prototype\Route;
use Core\Prototype\Request;


class TokenAuth implements AuthenticatorInterface
{
    protected Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function supports()
    {
        if ($this->request->getPath() === '/' && $this->request->getMethod() === 'GET') return false; 
        if ($this->request->getPath() === '/login' && $this->request->getMethod() === 'POST') return false;
        return true;
    }

    public function authorize()
    {
        $token = $this->request->getHeaders['Authorization'];
        return [];
    }

    
    public function onFailure() {
        throw new \Exception('Failed to authorize');
    }

    public function onSuccess() {
        return;
    }
}