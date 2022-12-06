<?php

namespace App\Services;

class LoginService extends DataBaseService
{
    public function getName(int $id): string
    {
        $sql="SELECT name FROM users WHERE id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$id);
        return $stmt->executeQuery()->fetchOne();
    }

    public function checkPassword(int $id, string $password): bool
    {
        $sql="select AES_DECRYPT(password,?) from users where id = ?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$_ENV['PASSWORD_KEY']);
        $stmt->bindValue(2,$id);
        $checkPassword=$stmt->executeQuery()->fetchOne();
        return ($password == $checkPassword);
    }
}
