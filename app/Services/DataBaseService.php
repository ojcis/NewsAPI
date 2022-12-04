<?php

namespace App\Services;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DataBaseService
{
    protected Connection $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DATA_BASE_NAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER'],
        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function getID(string $email): ?int
    {
        $sql="SELECT id FROM users WHERE email=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindValue(1,$email);
        return $stmt->executeQuery()->fetchOne();
    }
}
