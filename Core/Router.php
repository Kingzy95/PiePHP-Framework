<?php

namespace Core;

class Router
{
    private static $routes;

    public static function connect($url, $route)
    {
        self::$routes[$url] = $route;
    }

    public static function get($request)
    {
        // retourne un tableau associatif contenant
        // - le controller a instancier
        // - la methode du controller a appeler

        $url = trim($request->url); //--> exemple user/login
        $explodeUrl = explode('/', $url); //--> explode donne un tableau ['user,'login']
        $route = "";

        if (count($explodeUrl) === 1 && $explodeUrl[0] === '') {
            $route = '/';
        }
        if (count($explodeUrl) === 1 && $explodeUrl[0] !== '') {
            $route = "/". $url;
        }

        if (count($explodeUrl) > 1 && $explodeUrl[0] !== '' || strripos($url, '=') === 0) {
            $route = "/". $url;
        }

        if (count($explodeUrl) > 1 && $explodeUrl[0] !== '' && strripos($url, '=') > 0) {
            $route = "/". substr($url, 0, strripos($url, '/'));
        }

        if (isset(self::$routes[$route])) {

            $routeConfig = self::$routes[$route];

            $request->controller = $routeConfig['controller'];
            $request->action = $routeConfig['action'];

            // si définir et affecter les paramètres de la méthode à exécuter dans le controller
            $request->Params = array_slice($explodeUrl, 2);
            return true;
        }
        return false;
    }
}