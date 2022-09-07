<?php
namespace Core\Prototype\Security;

interface AuthenticatorInterface
{
    public function supports();

    public function authorize();

    public function onFailure();

    public function onSuccess();
}