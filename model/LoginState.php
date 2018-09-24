<?php

namespace model;

class LoginState {

    public function validateLoginInputData($loginData) {

        if ($loginData['LoginView::UserName'] == "") {
            throw new \Exception('Username is missing');

        } else if ($loginData['LoginView::Password'] == "") {
            throw new \Exception('Password is missing');
        }

    }

    public function validateDatabaseQuery($data) {

    }

}
