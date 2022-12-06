<?php

namespace App\Controllers;

use App\Models\NewUser;
use App\Services\RegisterService;
use App\Template;

class RegisterController
{
    public function showForm():Template
    {
        return new Template('register.twig');
    }

    public function register(): Template
    {
        $newUser= new NewUser(
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['checkPassword']
        );
        $dataBase= new RegisterService();
        $id=$dataBase->getID($newUser->getEmail());

        if ($id){
            return new Template('register.twig',[
                'error' => "This email is already used!",
                'name' => $newUser->getName(),
            ]);
        }

        if ($newUser->getPassword() != $newUser->getCheckPassword()){
            return new Template('register.twig',[
                'error' => 'Passwords does not mach!',
                'name' => $newUser->getName(),
                'email' => $newUser->getEmail()
            ]);
        }

        $dataBase->addToDataBase($newUser);

        $_SESSION['userId']=$id;
        $_SESSION['usersName']=$newUser->getName();

        return new Template('index.twig',[
            'userName' => $_SESSION['usersName']
        ]);
    }
}
