<?php 
namespace app\core;

use Exception;

class Controller
{
    public function execute(string $router)
    {   
        //str_contains é uma função do php8
        if (!str_contains($router, '@'))
        {
            //indica se a rota não está registrada com o @
            throw new Exception("A rota está registrada com o formato errado");
        }

        list($controller, $method) = explode('@', $router);
        //dd($controller, $method);

        $namespace = "app\controllers\\";
        $controllerNamespace = $namespace.$controller;
        //dd($controllerNamespace);
        if (!class_exists($controllerNamespace))
        {
            //indica se o controller existe
            throw new Exception("O controller {$controllerNamespace} não existe!");
        }
        $controller = new $controllerNamespace;
        //dd($controller);

        if(!method_exists($controller, $method))
        {
            //indica se o method existe
            throw new Exception("O método {$method} não existe no controller {$controllerNamespace}!");
        }

        $params = new ControllerParams;
        $filteredParams = $params->get($router);

        $controller->$method($filteredParams);

    }
}

?>