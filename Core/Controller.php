<?php

namespace Core;

class Controller {

    protected $request;
    private $layout = 'base.html.php';

    protected function redirect($route = '/') {
        if ('http' === substr($route, 0, 4)) {
            header('Location: ' . $route);
        } else {
            header('Location: ' . route($route));
        }
        die;
    }

    public function loadModel(String $name){
        if(!isset($this->name)){
            $file = 'src'.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.ucfirst($name).'.php';
            die($file);
            require_once($file);
            return $this->model = new $name(ucfirst($name));
        }
    }

    /**cette fonction est magique elle permet d'afficher d'afficher les pages
     *  de mettre à disposition les variables PHP dans toutes les pages html.php
     * cette fonction est utilisée dans tout les controllers.
     * @param [type] $view
     * @param array $variable
     * @return void
     */
    public function render($view, $variable = array()){
        
        try {
            
            extract($variable);
            ob_start();
            if ($view !== 'index.html.php') {
                require_once 'src'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$view;
                $view = ob_get_contents();
                if($view){
                    ob_end_clean();
                }
                return require_once 'src'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$this->layout;
            }
            require('src'. DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . $view);
            
            $view = ob_get_contents();
            if($view){
                ob_clean();
            }
            return (DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$this->layout);
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    
    public function redirectToRoute($url){
        header('Location:'.$url);
    }

    
    public function container(){
        return new class {
            public function dataForm() { 
                return new class {
                    private function getRequestData() {
                        $requestData = function(){
                            $data = [];
                            $response = [];
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $data = array_merge($data, $_POST);
                            }
                            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                                $data = array_merge($data, $_GET);
                            }
                            foreach($data as $key => $value){
                                $response [$key] = $value;
                            }
                            return  $response;
                        };
                        return   $requestData();
                    }
                    public function get($arg){
                        $REQUEST_METHOD = $this->getRequestData();
                        if (isset($REQUEST_METHOD[$arg])){
                            return  htmlspecialchars($REQUEST_METHOD[$arg]);
                        }
                        return NULL;
                    }
                };
            }
            public function request(){
                return new class {
                    public function method(){
                        return $_SERVER['REQUEST_METHOD']; 
                    }
                };
            }
            
        };
    }

    public function isPost(){
        return ($this->container()->request()->method()==='POST')? true : false;
    }

}
