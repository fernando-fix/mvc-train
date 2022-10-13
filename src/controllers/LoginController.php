<?php

namespace src\controllers;

use \core\Controller;
use \src\models\User;
use \src\handlers\LoginHandler;

class LoginController extends Controller
{

    public function signin()
    {
        $this->render('/login');
    }

    public function signin_action()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
            
        $loggedUser = LoginHandler::checkLogin($email, $password);

        if($loggedUser == false) {
            $this->redirect('/login');
        } else {
            $this->redirect('/');
        }
            
       
    }

    public function signup()
    {
    }
}
