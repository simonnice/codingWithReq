<?php

namespace controller;

class MainController {

    private $layoutView;
    private $loginView;
    private $postView;
    private $registerView;
    private $dateTimeView;
    private $loginController;
    private $registerController;
    private $postController;
    private $session;
    private $db;
    private $responseMessages;
    private $cookie;

    public function __construct() {
        $this->session = new \model\Session();
        $this->db = new \model\Database($this->session);
        $this->cookie = new \model\Cookie();

        //CREATE OBJECTS OF THE VIEWS
        $this->loginView = new \view\LoginView();
        $this->postView = new \view\postView($this->session);
        $this->dateTimeView = new \view\DateTimeView();
        $this->registerView = new \view\RegisterView();
        $this->responseMessages = new \view\Response();

        $this->layoutView = new \view\LayoutView($this->dateTimeView, $this->loginView, $this->registerView, $this->postView);

        // CREATE OBJECTS OF THE CONTROLLER
        $this->loginController = new \controller\LoginController($this->loginView, $this->db, $this->session, $this->cookie);
        $this->registerController = new \controller\RegisterController($this->registerView, $this->session, $this->db);
        $this->postController = new \controller\postController($this->db, $this->session);
    }

    public function startApp() {
        if ($this->loginView->isLoginButtonClicked()) {
            $this->loginLogic();

        } else if ($this->registerView->registerLinkIsClicked()) {
            $this->registerLogic();

        } else if ($this->loginView->isLogoutButtonClicked()) {
            $this->logoutLogic();

        } else if ($this->loginView->isCreatePostLinkClicked()) {
            $this->postLogic();
        } else {
            $this->StartLogic();

        }

    }

    public function postLogic() {
        try {
            if ($this->postView->isCreatePostButtonClicked()) {
                $postInfo = new \model\Post($this->postView->getActiveUser(), $this->postView->getPostTitle(), $this->postView->getPostBody(), $this->db);
                $this->postController->sendPostInfoToDB($postInfo);
                $response = $this->postView->generatePostFormHtml($this->responseMessages::successfulPost);
                $this->layoutView->echoHtml(true, $response, 'post');
            } else {
                echo "this runs";
                $response = $this->postView->generatePostFormHtml($this->responseMessages::noFeedback);
                $this->layoutView->echoHtml(true, $response, 'post');
            }

        } catch (\Exception $e) {
            $this->layoutView->echoHtml(true, $e->getMessage(), 'post');
        }
    }

    public function registerLogic() {
        try {
            if ($this->registerView->isRegisterButtonClicked()) {
                $registerInfo = new \model\Register($this->registerView->getRegisterUserName(),
                    $this->registerView->getRegisterPassword(), $this->registerView->getRegisterRepeatedPassword(), $this->db);
                $this->registerController->sendRegisterInfoToDb($registerInfo);
                $response = $this->registerView->registerResponse($this->responseMessages::successfulRegistration);
                $this->loginView->setRegisteredUserName($registerInfo->getUserName());
                $this->layoutView->echoHtml(false, $response, 'login');
            } else {
                $response = $this->registerView->registerResponse($this->responseMessages::noFeedback);
                $this->layoutView->echoHtml(false, $response, 'register');
            }

        } catch (\Exception $e) {
            $this->registerView->setUserName($this->registerView->getRegisterUserName());
            $this->layoutView->echoHtml(false, $e->getMessage(), 'register');
        }

    }

    public function loginLogic() {

        try {
            $loginInfo = new \model\Login($this->loginView->getLoginUserName(), $this->loginView->getLoginPassword(), $this->db);
            if ($this->loginController->keepUserLoggedIn()) {
                if ($this->cookie->isCookieSet()) {
                    $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
                    $this->layoutView->echoHtml(true, $response, 'login');
                } else {
                    $this->loginController->loginWithCookie($loginInfo);
                    $response = $this->loginView->loginResponse($this->responseMessages::welcomeRemember);
                    $this->layoutView->echoHtml(true, $response, 'login');
                }
            } else if ($this->loginController->loggedInWithSession()) {
                $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
                $this->layoutView->echoHtml(true, $response, 'login');
            } else {
                $this->loginController->login($loginInfo);
                $response = $this->loginView->loginResponse($this->responseMessages::welcomeMessage);
                $this->layoutView->echoHtml(true, $response, 'login');

            }

        } catch (\Exception $e) {
            $this->loginView->setRegisteredUserName($this->loginView->getLoginUserName());
            $this->layoutView->echoHtml(false, $e->getMessage(), 'login');
        }
    }

    public function logoutLogic() {
        if ($this->loginController->logoutResponse()) {
            $response = $this->loginView->loginResponse($this->responseMessages::bye);
            $this->layoutView->echoHtml(false, $response, 'login');
        } else {
            $response = $this->registerView->registerResponse($this->responseMessages::noFeedback);
            $this->layoutView->echoHtml(false, $response, 'login');
        }
    }

    public function StartLogic() {
        // Logic for first path
        if ($this->loginController->loggedInWithCookie()) {
            $response = $this->loginView->loginResponse($this->responseMessages::welcomeCookie);
            $this->layoutView->echoHtml(true, $response, 'login');
        } else if ($this->loginController->isLoggedIn()) {
            $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
            $this->layoutView->echoHtml(true, $response, 'login');
        } else {
            $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
            $this->layoutView->echoHtml(false, $response, 'login');
        }
    }

}
