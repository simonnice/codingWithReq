<?php

namespace controller;

class MainController {

    private $layoutView;
    private $userController;
    private $userModel;
    private $loginView;
    private $dateView;
    private $responseArray;

    public function __construct($layout, $userC, $userM, $login, $date) {
        $this->layoutView = $layout;
        $this->userController = $userC;
        $this->userModel = $userM;
        $this->loginView = $login;
        $this->dateView = $date;
        $this->responseArray = array();
    }

    public function startApp() {
        if ($this->loginView->isLoginButtonClicked()) {
            $this->responseArray = $this->userController->loginResponseFromDatabase();
            $this->layoutView->echoHtml(false, $this->loginView, $this->dateView, $this->responseArray);
        } else {
            $this->layoutView->echoHtml(false, $this->loginView, $this->dateView, $this->responseArray);
        }
    }
}
