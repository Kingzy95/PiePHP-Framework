<?php

namespace src;
use Core\Router;

class Routes
{

    public function getRoutesConfig(Router $router)
    {
        // INDEX & 404
        $router::connect('/', ['controller' => 'app', 'action' => 'index']);
        $router::connect('/404', ['controller' => 'user', 'action' => 'add']);

        //DEFAULT ROUTES
        $router::connect('/user', ['controller' => 'user', 'action' => 'default']);
        $router::connect('/app', ['controller' => 'app', 'action' => 'default']);
        $router::connect('/error', ['controller' => 'error', 'action' => 'default']);

        // USER ROUTES
        $router::connect('/register', ['controller' => 'user', 'action' => 'register']);
        $router::connect('/login', ['controller' => 'login', 'action' => 'logIn']);
        $router::connect('/about', ['controller' => 'user', 'action' => 'about']);
        return true;
    }
}
