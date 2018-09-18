<?php

namespace controller;

class registerController {

    private $state;
    private $registerView;

    public function __construct(\model\registerState $state, $register) {
        $this->state = $state;
        $this->registerView = $register;
    }

    /**
     * Handle a GET request to Register.php
     *
     */

    public function checkLoginCredentials() {
        if ($this->loginView->isLoginButtonClicked() == true) {

            $data = $this->loginView->getFormData();
            return $this->state->checkInputData($data);
        }

    }

}
