<?php

namespace Http\Controllers;

use Core\App;
use Core\Session;
use Core\Validator;

class AuthenticationController
{
    public function loginForm()
    {
        return view('auth.login', [
            'heading' => 'Login'
        ]);
    }

    public function login()
    {
        $session = new Session();
        $session->clear();

        $email = $_POST['email'];
        $password = $_POST['password'];
        $validator = new Validator();
        $validator->name('email')->value($email)->email()->required();
        $validator->name('password')->value($password)->min(4)->max(16)->required();
        if (!$validator->passes()) {
            $session->set('errors', $validator->getErrors());
            redirect('/login');
        }
    }

    public function register()
    {
    }

    public function logout()
    {
    }
}
