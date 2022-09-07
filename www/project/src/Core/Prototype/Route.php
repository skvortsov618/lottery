<?php

namespace Core\Prototype;

class Route
{
    protected string $name;
    protected string $path;
    protected array $methods;
    protected string $controller;
    protected string $classMethod;

    public function __construct(string $name, string $path, array $methods, string $contoller, string $classMethod)
    {
        $this->name = $name;
        $this->path = $path;
        $this->methods = $methods;
        $this->controller = $contoller;
        $this->classMethod = $classMethod;
    }

    public function match(string $path, string $method)
    {
        return ($this->path === $path && in_array($method, $this->methods));
    }

    public function getPath()
    {
        return $path;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getClassMethod()
    {
        return $this->classMethod;
    }
}