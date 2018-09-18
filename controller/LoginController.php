<?php

namespace controller;

class loginController {

    private $state;
    private $loginView;

    public function __construct(\model\LoginState $state, $login) {
        $this->state = $state;
        $this->loginView = $login;
    }

    /**
     * Handle a login request to the site
     *
     */

    public function checkLoginCredentials() {
        if ($this->loginView->isLoginButtonClicked() == true) {

            $data = $this->loginView->getFormData();
            return $this->state->checkInputData($data);
        }

    }

}
