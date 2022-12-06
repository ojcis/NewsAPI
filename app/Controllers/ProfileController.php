<?php

namespace App\Controllers;

use App\Services\ProfileUpdateService;
use App\Template;

class ProfileController
{
    public function showForm():Template
    {
        $update = $_GET['update'] ?? false;
        return new Template('profile.twig',[
            $update => true,
            'user' => $_SESSION['userName']
        ]);
    }

    public function changeName(): Template
    {
        $dataBase=new ProfileUpdateService();
        $newName=$_POST['name'];
        $password=$_POST['password'];

        if (!$dataBase->checkPassword($password)){
            return new Template('profile.twig',[
                'changeName' => true,
                'error' => 'Wrong password!',
                'name' => $newName
            ]);
        }
        $dataBase->changeName($newName);
        $_SESSION['userName']=$newName;
        return new Template('index.twig',[
            'userName' => $_SESSION['userName']
        ]);
    }

    public function changeEmail(): Template
    {
        $dataBase=new ProfileUpdateService();
        $newEmail=$_POST['email'];
        $password=$_POST['password'];

        if (!$dataBase->checkPassword($password)){
            return new Template('profile.twig',[
                'changeEmail' => true,
                'error' => 'Wrong password!',
                'email' => $newEmail
            ]);
        }
        $dataBase->changeEmail($newEmail);
        return new Template('index.twig',[
            'userName' => $_SESSION['userName']
        ]);
    }

    public function changePassword(): Template
    {
        $dataBase=new ProfileUpdateService();
        $password=$_POST['password'];
        $newPassword=$_POST['newPassword'];
        $checkNewPassword=$_POST['checkNewPassword'];

        if (!$dataBase->checkPassword($password)){
            return new Template('profile.twig',[
                'changePassword' => true,
                'error' => 'Wrong current password!',
            ]);
        }

        if ($newPassword != $checkNewPassword){
            return new Template('profile.twig',[
                'changePassword' => true,
                'error' => 'New passwords does not mach!',
            ]);
        }
        $dataBase->changePassword($newPassword);
        return new Template('index.twig',[
            'userName' => $_SESSION['userName']
        ]);
    }

    public function deleteAccount(): Template
    {
        $dataBase=new ProfileUpdateService();
        $password=$_POST['password'];

        if (!$dataBase->checkPassword($password)){
            return new Template('profile.twig',[
                'changePassword' => true,
                'error' => 'Wrong password!',
            ]);
        }
        $dataBase->deleteAccount();
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        return new Template('index.twig');
    }
}
