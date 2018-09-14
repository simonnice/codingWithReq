<?php

namespace model;

class LoginState {

    private $inputResult;

    public function checkInputData($loginData) {

        $this->inputResult = $loginData;

        if ($this->inputResult['LoginView::UserName'] == 'hej') {
            return "Username is missing";
        }
    }
}
