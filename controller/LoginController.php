<?php

class loginController {

    public function __construct(\model\LoginState $state, $login) {
        $this->state = $state;
        $this->loginView = $login;
        $this->checkLoginCredentials();
    }

    /**
     * Handle a login request to the site
     *
     */

    private function checkLoginCredentials() {
        if ($this->loginView->isLoginButtonClicked() == true) {
            // Debug purpose echo
            echo $this->loginView->getFormUserName();
        }
    }

}
