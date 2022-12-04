<?php

namespace App\Services;

use App\Models\NewUser;

class RegisterService extends DataBaseService
{
    public function addToDataBase(NewUser $newUser)
    {
        $sql='insert into users(email,name,password) value(?,?,AES_ENCRYPT(?,?))';
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$newUser->getEmail());
        $stmt->bindValue(2,$newUser->getName());
        $stmt->bindValue(3,$newUser->getPassword());
        $stmt->bindValue(4,$_ENV['PASSWORD_KEY']);
        $stmt->executeQuery();
    }
}