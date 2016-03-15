<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class App
{
    private $app;

    public function __construct()
    {
        $this->getSlimApp();

    }

    public function getSlimApp()
    {
        $this->app = new Slim([
            'view' => new Twig(),
            'templates.path' => 'app/views'
        ]);

        $view = $this->app->view();

        $view->parserOptions = [
            'debug' => true,
            //'cache' => dirname(__FILE__) . '/cache'
        ];

        $view->parserExtensions = [
            new TwigExtension(),
        ];
    }

    public function run()
    {
        $this->app->run();
    }

    public function get($url, $action)
    {
        return $this->call('get', $url, $action);
    }

    public function post($url, $action)
    {
        return $this->call('post', $url, $action);
    }

    public function call($methodType, $url, $action)

    {
        return $this->app->$methodType($url, function () use ($action) {
            $action = explode('@', $action);
            $controller = $action[0];
            $method = $action[1];
            $controller = new $controller($this->app);
            call_user_func_array([$controller, $method], func_get_args());
        });
    }

}