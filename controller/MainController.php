<?php

namespace controller;

class MainController {

    private $layoutView;
    private $loginView;
    private $registerView;
    private $userController;
    private $responseArray;

    public function __construct($layout, $userC, $login, $register) {
        $this->layoutView = $layout;
        $this->loginView = $login;
        $this->registerView = $register;
        $this->userController = $userC;
        $this->responseArray = array();
    }

    public function startApp() {
        if ($this->loginView->isLoginButtonClicked()) {
            $this->responseArray = $this->userController->loginResponseFromDatabase();
            $this->layoutView->echoHtml(false, $this->responseArray, 'login');
        } else if ($this->registerView->registerLinkIsClicked()) {
            $this->layoutView->echoHtml(false, $this->responseArray, 'register');
        } else {
            $this->layoutView->echoHtml(false, $this->responseArray, 'login');
        }
    }

}
