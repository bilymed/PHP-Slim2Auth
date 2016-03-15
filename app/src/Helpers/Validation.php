<?php

namespace App\Helpers;

use Violin\Violin;

class Validation extends Violin
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Validation();
        }
        //var_dump(self::$instance);


        return self::$instance;
    }

}