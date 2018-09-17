<?php

namespace model;

class LoginState {

    public function checkInputData($loginData) {

        if ($loginData['LoginView::UserName'] == "") {
            return $loginData['LoginView::Message'] = "Username is missing";
        } else if ($loginData['LoginView::Password'] == "") {
            return $loginData['LoginView::Message'] = "Password is missing";
        }
    }
}
