<?php

namespace App\Services;

class ProfileUpdateService extends DataBaseService
{
    public function checkPassword(string $password): bool
    {
        $sql="select AES_DECRYPT(password,?) from users where id = ?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$_ENV['PASSWORD_KEY']);
        $stmt->bindValue(2,$_SESSION['userId']);
        $checkPassword=$stmt->executeQuery()->fetchOne();
        return ($password == $checkPassword);
    }

    public function changeName(string $newName): void
    {
        $sql="UPDATE users SET name=? WHERE id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$newName);
        $stmt->bindValue(2,$_SESSION['userId']);
        $stmt->executeQuery();
    }

    public function changeEmail(string $newEmail): void
    {
        $sql="UPDATE users SET email=? WHERE id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$newEmail);
        $stmt->bindValue(2,$_SESSION['userId']);
        $stmt->executeQuery();
    }

    public function changePassword(string $newPassword): void
    {
        $sql="UPDATE users SET password=AES_ENCRYPT(?,?)WHERE id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$newPassword);
        $stmt->bindValue(2,$_ENV['PASSWORD_KEY']);
        $stmt->bindValue(3,$_SESSION['userId']);
        $stmt->executeQuery();
    }

    public function deleteAccount(): void
    {
        $sql="DELETE FROM users WHERE id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$_SESSION['userId']);
        $stmt->executeQuery();
    }
}
