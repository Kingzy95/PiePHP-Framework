<?php

use Core\Controller;

class LoginController extends Controller
{
    public function logIn(){
        return $this->render('User/login.html.php', 
        [
            'Controller' => 'LoginController'
        ]);
    }
}
