<?php
namespace Core;

use Core\Prototype\RuntimeInterface;
use Core\Prototype\Kernel;
use Core\Prototype\Request;
use Core\Prototype\Route;
use Symfony\Component\Yaml\Yaml;

class Runtime implements RuntimeInterface
{
    protected Kernel $kernel;
    protected Request $request;
    protected $response;

    public function __construct()
    {
        $this->initKernel();
        $this->initRequest();
    }

    public function run()
    {
        $route = $this->kernel->getRoute($this->request->getPath(), $this->request->getMethod());
        if (!$route instanceof Route) die('404'); // TODO serve nice 404 response
        $this->request->setRoute($route);

        $user = $this->kernel->runSecurity($this->request);
        $this->request->setUser($user);

        echo $this->kernel->runController($this->request);

        // $this->runSecurity()
        //     ->runController()
        //     ->serveResponse()
        // ;

        // $reflection = new \ReflectionClass($services['controllers'][0]);
        // $methods = $reflection->getMethods();
        // echo '</br>';
        // $attributes = $methods[0]->getAttributes();
        // var_dump($attributes[0]->getName());
        // foreach ($attributes as $attribute) {
        //     var_dump($attribute->getArguments());
        // }
        // echo '</br>';
        
        // init services and routes
        // if no route - throw 404
        // run firewalls -> if none supports path continue
        // run security -> get user or throw exception
        // run controller -> get response
        // handle response


        // $security = new $services['firewalls'][0]();
        // $security->supports();

        // $controller = new $routes['Routes'][0]['controller'];
        // $method = $routes['Routes'][0]['method'];
        // $controller->$method();
    }

    protected function initKernel()
    {
        $this->kernel = new Kernel();

        $ymlServices = Yaml::parseFile(PROJECT_DIR.'/config/services.yml');

        $this->kernel->setServices($ymlServices);

        $this->kernel->setRoutes();
    }

    protected function initRequest()
    {
        $this->request = new Request();
        $this->request->setPath($_SERVER['REQUEST_URI']);
        $this->request->setMethod($_SERVER['REQUEST_METHOD']);
        $this->request->setHeaders([
            'Authorization' => $_SERVER['HTTP_AUTHORIZATION'] ?? null,
            'Content-Type' => $_SERVER['HTTP_CONTENT_TYPE'] ?? null
        ]);

        $data = [];
        switch ($this->request->getHeaders()['Content-Type']) {
            case 'application/json':
                $data = json_decode(file_get_contents('php://input'), true);
                break;
            default:
                $data = $_REQUEST;
                break;
        }
        $this->request->setArgs($data);
        
    }

    public function getEnvironment()
    {
        echo '</br>SERVER: </br>';
        foreach ($_SERVER as $key => $value)
        {
            if (is_array($value)) {
                var_dump($value);
            } else {
                echo $key.' - '.$value.'</br>';
            }
        }
        echo '</br>REQUEST: </br>';
        foreach ($_REQUEST as $key => $value)
        {
            echo $key.' - '.$value.'</br>';
        }
        echo '</br>POST: </br>';
        foreach ($_POST as $key => $value)
        {
            echo $key.' - '.$value.'</br>';
        }
        var_dump(json_decode(file_get_contents('php://input'), true));
    }

    protected function serveResponse()
    {
        echo $this->response['body'];
        return $this;
    }
}