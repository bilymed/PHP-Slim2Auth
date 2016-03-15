<?php

namespace App\Helpers;

class Hash
{
    private static $instance;

    public function password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
    }

    public function passwordCheck($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Hash();
        }

        return self::$instance;
    }

}