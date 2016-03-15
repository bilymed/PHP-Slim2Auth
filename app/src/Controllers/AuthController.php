<?php

namespace App\Controllers;

use App\Helpers\Hash;
use App\Helpers\Validation;
use App\Models\User;

class AuthController extends Controller
{
    public function getSignUp()
    {
        $this->app->render('auth/signup.html.twig');
    }

    public function postSignUp()
    {
        $request = $this->app->request;
        $email = $request->post('email');
        $username = $request->post('username');
        $password = $request->post('password');
        $passwordConfirm = $request->post('password_confirm');

        $validation = Validation::getInstance();

        $validation->validate([
            'email' => [$email, 'required|email']
        ]);

        if ($validation->passes()) {
            User::create([
                'email' => $email,
                'password' => Hash::getInstance()->password($password),
                'username' => $username,
            ]);

            $this->app->flash('global', 'you have been registred');
            $this->app->response->redirect($this->app->urlFor('home'));

        } else {
            $this->app->render("auth/signup.html.twig", [
                "errors" => $validation->errors(),
                "request" => $request
            ]);
        }
    }
}