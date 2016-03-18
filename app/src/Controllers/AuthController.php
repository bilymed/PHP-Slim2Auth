<?php

namespace App\Controllers;

use App\Helpers\Hash;
use App\Helpers\Validation;
use App\Models\User;

class AuthController extends Controller
{
    public function getSignUp()
    {
        $this->app->render('auth/signup.twig');
    }

    public function postSignUp()
    {
        $email = $this->app->request->post('email');
        $username = $this->app->request->post('username');
        $password = $this->app->request->post('password');
        $passwordConfirm = $this->app->request->post('password_confirm');

        $validation = Validation::getInstance();
        $hash = Hash::getInstance();

        $validation->validate([
            'email' => [$email, 'required|email|uniqueEmail'],
            'username' => [$username, 'required|alnumDash|max(20)'],
            'password' => [$password, 'required|min(6)'],
            'password_confirm' => [$passwordConfirm, 'required|matches(password)'],
        ]);

        if ($validation->passes()) {
            User::create([
                'email' => $email,
                'username' => $username,
                'password' => $hash->password($password),
            ]);

            $this->app->flash('global', 'you have been registred');
            $this->app->response->redirect($this->app->urlFor('home'));

        } else {
            $this->app->render('auth/signup.twig', [
                'errors' => $validation->errors(),
                'request' => $this->app->request,
            ]);
        }
    }

    public function getSignIn()
    {
        $this->app->render('auth/signin.twig');
    }

    public function postSignIn()
    {
        $identity = $this->app->request->post('identity');
        $password = $this->app->request->post('password');

        $validation = Validation::getInstance();
        $hash = Hash::getInstance();

        $validation->validate([
            'identity' => [$identity, 'required'],
            'password' => [$password, 'required'],
        ]);

        if ($validation->passes()) {
            $user = User::where('email', $identity)
                ->orwhere('username', $identity)
                ->first();
            if ($user && $hash->passwordCheck($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $this->app->flash('global', 'Success!');
                $this->app->response->redirect($this->app->urlFor('home'));
            } else {
                $this->app->flash('global', 'Cound not Log you in!');
                $this->app->response->redirect($this->app->urlFor('singIn.post'));
            }

        } else {
            $this->app->render('auth/signin.twig', [
                'errors' => $validation->errors(),
                'request' => $this->app->request,
            ]);
        }
    }
}