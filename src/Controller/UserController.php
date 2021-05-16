<?php

use Core\Controller;
use Model\UserModel;

class UserController extends Controller
{
    public function default(){
        return $this->render('User/index.php', 
        [
            'title' => 'Inscription' 
        ]);
    }

    public function add(){
        //echo 'ERROR 404';
        return $this->render('Error/404.html.php', 
        [
            'controller' => 'UserController'
        ]);
    }

    public function register(){
        return $this->render('User/register.html.php', 
        [
            'title' => 'Register'
        ]);
    }

    public function about(){
        return $this->render('User/about.html.php',
        [
            'title' => 'About'
        ]);
    }

}