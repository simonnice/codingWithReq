<?php

class loginController {

    private $state;
    private $loginView;

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
            $loginData = $this->loginView->getFormData();
            // var_dump($loginData);
            echo $loginData['LoginView::UserName'];
            echo $loginData['LoginView::Password'];
        }
    }

}
