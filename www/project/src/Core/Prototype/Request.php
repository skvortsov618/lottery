<?php
namespace Core\Prototype;

use Core\Prototype\RequestInterface;
use Core\Prototype\Route;
use Core\Prototype\UserInterface;

class Request implements RequestInterface
{

    protected string $method;
    protected string $path;
    protected ?UserInterface $user;
    protected Route $route;
    protected array $headers;
    protected array $args;

    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setUser(?UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setArgs(array $args)
    {
        $this->args = $args;
    }

    public function get(string $argName)
    {
        foreach ($this->args as $key=>$value) {
            if ($key = $argName) return $value;
        }
        return null;
    }
}