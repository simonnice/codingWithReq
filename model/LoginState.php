<?php

namespace model;

class LoginState {

    public function checkInputData($loginData) {

        if ($loginData['LoginView::UserName'] == "") {
            throw new \Exception('Username is missing');

        } else if ($loginData['LoginView::Password'] == "") {
            throw new \Exception('Password is missing');
        }

    }

}
