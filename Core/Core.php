<?php

namespace Core;
use Core\Router;
use Core\Request;
use Exception;
use src\Routes;

class Core {
    /**
     * @var \Core\Request
     */
    private $request;
    /**
     * @var bool
     */
    private $isExistRoute;

    /**
     * Core constructor.
     */
    public function __construct(){
        $this->request = new Request();
        $routes        = new Routes();
        $this->router  = new Router();

        $routes->getRoutesConfig($this->router);
        $this->isExistRoute = $this->router::get($this->request);

    }

    /**
     * @return false|mixed
     */
    public function run() {
        try{
            if($this->isExistRoute){
                $controller = $this->loadController();
                if(!in_array($this->request->action,get_class_methods($controller))){
                    $this->error('La Page '.$controller->request->action.' introuvable');
                }
                $method = new \ReflectionMethod($controller, $this->request->action);
                if(!empty($method->getParameters()) && $this->request->Params[0] === "")
                {
                    throw new Exception("La fonction appelée exige un paramètre");
                }
                return call_user_func_array(array($controller,$this->request->action),$this->request->Params);
            }
            throw new Exception("La route n'existe pas");
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    /**
     * @param $message
     */
    function error($message){
        die($message);
    }

    /**
     * @return mixed
     */
    function loadController(){
        try{
            $name = ucfirst($this->request->controller).'Controller';
            $file = str_replace(__DIR__, 'src',__DIR__) . DIRECTORY_SEPARATOR .'Controller'. DIRECTORY_SEPARATOR . $name .'.php';
            //die($name);
            if(file_exists($file)){
                require($file);
                return new $name($this->request);
            }

            $this->error("Le controller ". $name. ".php n'existe pas" );
        }catch(Exception $e){
            debug('La Page');
        }
    }

}