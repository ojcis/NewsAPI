<?php

namespace App\Models;

class NewUser
{
    private string $name;
    private string $email;
    private string $password;
    private string $checkPassword;

    public function __construct(string $name, string $email, string $password, string $checkPassword)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->checkPassword = $checkPassword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCheckPassword(): string
    {
        return $this->checkPassword;
    }
}
