<?php

namespace App\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        $this->app->render('home.html.twig');
    }

    public function contact()
    {
        $this->app->render('contact.html.twig');
    }

    public function test()
    {
        $this->app->flash('global', 'You have registered');
        $this->app->response->redirect($this->app->urlFor('home'));
    }

}