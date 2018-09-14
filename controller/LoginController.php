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

            $loginData = $this->loginView->getFormData();

            $this->loginView->response($this->state->checkInputData($loginData));
            // var_dump($loginData);
            // Debug purpose echo
            // echo $loginData['LoginView::UserName'];
            // echo $loginData['LoginView::Password'];
        }
    }

}
