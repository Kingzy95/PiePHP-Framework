<?php

use Core\Controller;

class AppController extends Controller{

    public function index() { 
        return $this->render('App/HomePage.html.php',
        [
            'title'=>'HomePage',
        ]);
    }
}