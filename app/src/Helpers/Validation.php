<?php

namespace App\Helpers;

use App\Models\User;
use Violin\Violin;

class Validation extends Violin
{
    protected $user;

    public function __construct()
    {
        $this->addFieldMessages(['email' => ['uniqueEmail' => 'That email is already in use']]);
    }


    public function validate_uniqueEmail($value)
    {
        $user = User::where('email', $value);
        return !(bool)$user->count();
    }

    private static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Validation();
        }
        return self::$instance;
    }

}