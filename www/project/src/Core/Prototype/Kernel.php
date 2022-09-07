<?php
namespace Core\Prototype;

use Core\Prototype\KernelInterface;
use Core\Prototype\Request;
use Core\Prototype\Route;

class Kernel implements KernelInterface
{
    protected $services;
    protected $routes;

    public function setServices(array $services)
    {
        $this->services = $services;
    }

    public function setRoutes()
    {
        foreach ($this->services['controllers'] as $controller) {
            $reflectionClass = new \ReflectionClass($controller);
            $methods = $reflectionClass->getMethods();
            foreach ($methods as $method) {
                foreach ($method->getAttributes() as $methodAttribute) {
                    if ($methodAttribute->getName() == 'Controllers\Route') {
                        $arguments = $methodAttribute->getArguments();
                        $this->routes[] = new Route($arguments['name'], $arguments['path'], $arguments['methods'], $controller, $method->getName());
                    }
                }
            }
        }
        return $this;
    }

    public function runSecurity(Request $request)
    {
        $user = null;

        if (!is_array($this->services['authenticators'])) return null;
        foreach ($this->services['authenticators'] as $authenticatorClass) {
            $authenticator = new $authenticatorClass($request);
            if ($authenticator->supports()) {
                $user = $authenticator->authorize();
                if ($user instanceof UserInterface) {
                    $authenticator->onSuccess();
                } else {
                    $authenticator->onFailure();
                }
                break;
            }
        }
        return $user;
    }


    public function runController(Request $request)
    {
        $controllerName = $request->getRoute()->getController();
        $methodName = $request->getRoute()->getClassMethod();

        $controller = new $controllerName();

        $response = $controller->$methodName($request);

        return $response;
    }


    public function getRoute(string $path, string $method)
    {
        if ($this->routes === null) return null;
        foreach ($this->routes as $route) {
            if ($route->match($path, $method)) return $route;
        }
        return null;
    }
}