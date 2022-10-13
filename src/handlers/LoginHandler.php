<?php
namespace src\handlers;

use src\models\User;

class LoginHandler {

    public static function whoIsLogged() {

        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $data = User::select()->where('token',$token)->one();
            $loggedUser = new User;
            $loggedUser->id = $data['id'];
            $loggedUser->name = $data['name'];
            $loggedUser->email = $data['email'];
            $loggedUser->token = $data['token'];
            return $loggedUser;
        }

        return false;
    }

    public static function checkLogin($email, $password) {


        if (!empty($email && !empty($password))) {
            $data = User::select()->where('email', $email)->one();
            if(count($data) > 0) {
                if(password_verify($password, $data['password'])) {

                    //new token
                    $newToken = md5(time().rand(0,9999).time());
                    $_SESSION['token'] = $newToken;
                    User::update()->set('token', $newToken)->where('email', $email)->execute();
                    
                    $loggedUser = new User;
    
                    $loggedUser->id = $data['id'];
                    $loggedUser->name = $data['name'];
                    $loggedUser->email = $data['email'];
                    $loggedUser->token = $data['token'];
    
                    return $loggedUser;
                }
            }
        }
        return false;
    }
}