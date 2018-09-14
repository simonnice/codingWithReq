<?php

class loginController {

    public function __construct(\model\loginState $state, $login) {
        $this->state = $state;
        $this->loginView = $login;
        $this->checkLoginCredentials();
    }

    /**
     * Handle a login request to the site
     *
     */

    private function checkLoginCredentials() {
        if (this->loginView->fetchLoginData() == true) {
            
        }
    }

}
