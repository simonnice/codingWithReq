<?php

namespace model;

class LoginState {

    public function checkInputData($loginData) {
        if ($loginData['LoginView::UserName'] == null) {
            return "Username is missing";
        }
    }
}
