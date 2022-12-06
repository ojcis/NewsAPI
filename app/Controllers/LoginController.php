<?php

namespace App\Controllers;

use App\Services\LoginService;
use App\Template;

class LoginController
{
    public function showForm():Template
    {
        return new Template('login.twig');
    }

    public function login(): Template
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $dataBase= new LoginService();
        $id=$dataBase->getID($email);

        if (!$id){
            return new Template('login.twig',[
                'error' => "No registered user with this email!"
                ,]);
        }

        if (!$dataBase->checkPassword($id, $password)){
            return new Template('login.twig',[
                'error' => "Wrong email or password!",
                'email' => $email
            ]);
        }

        $_SESSION['userId']=$id;
        $_SESSION['userName']=$dataBase->getName($id);
        return new Template('index.twig',[
            'userName' => $_SESSION['userName']
        ]);
    }
}
