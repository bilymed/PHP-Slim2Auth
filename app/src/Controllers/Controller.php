<?php

namespace App\Controllers;

use Slim\Slim;

class Controller
{
    protected $app;

    public function __construct()
    {
        $this->app = Slim::getInstance();
    }

}