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
    private $userFeedback;
    private $cookie;

    public function __construct() {
        $this->session = new \model\Session();
        $this->db = new \model\Database($this->session);
        $this->cookie = new \model\Cookie();

        //CREATE OBJECTS OF THE VIEWSS
        $this->loginView = new \view\LoginView();
        $this->postView = new \view\postView($this->session);
        $this->dateTimeView = new \view\DateTimeView();
        $this->registerView = new \view\RegisterView();
        $this->userFeedback = new \view\UserFeedback();

        $this->layoutView = new \view\LayoutView($this->dateTimeView, $this->loginView, $this->registerView, $this->postView);

        // CREATE OBJECTS OF THE CONTROLLER
        $this->loginController = new \controller\LoginController($this->loginView, $this->session, $this->cookie);
        $this->registerController = new \controller\RegisterController($this->db);
        $this->postController = new \controller\postController($this->db);
    }

    public function startApp() {
        $scenario = true;
        switch ($scenario) {
            case $this->loginView->isLoginButtonClicked():
                $this->loginLogic();
                break;

            case $this->postView->isCreatePostLinkClicked():
                $this->createPostLogic();
                break;

            case $this->postView->isShowPostsLinkClicked():
                $this->showPostsLogic(false);
                break;

            case $this->postView->isDeleteButtonClicked():
                $this->showPostsLogic(true);
                break;

            case $this->registerView->isRegisterLinkClicked():
                $this->registerLogic();
                break;

            case $this->loginView->isLogoutButtonClicked():
                $this->logoutLogic();
                break;

            default:
                $this->StartLogic();
        }
    }

    public function createPostLogic() {
        try {
            if ($this->postView->isCreatePostButtonClicked()) {
                $postInfo = new \model\Post($this->postView->getActiveUserId(), $this->postView->getPostTitle(), $this->postView->getPostBody(), $this->db);
                $this->postController->sendPostInfoToDB($postInfo);
                $responseToUser = $this->postView->postResponse($this->userFeedback::successfulPost);
                $this->layoutView->echoHtml(true, $responseToUser, 'post');
            } else {

                $responseToUser = $this->postView->postResponse($this->userFeedback::noFeedback);
                $this->layoutView->echoHtml(true, $responseToUser, 'post');
            }

        } catch (\Exception $e) {
            $this->layoutView->echoHtml(true, $e->getMessage(), 'post');
        }
    }

    public function showPostsLogic($isDeleteRequest) {
        try {
            if ($isDeleteRequest) {
                $postToDelete = $this->postView->getPostId();
                $this->postController->deletePostFromDB($this->session->getCurrentUserId(), $postToDelete);
                $responseToUser = $this->postController->getPostsFromDB($this->session->getCurrentUserId());
                $this->layoutView->echoHtml(true, $responseToUser, 'show');
            } else {

                $responseToUser = $this->postController->getPostsFromDB($this->session->getCurrentUserId());
                $this->layoutView->echoHtml(true, $responseToUser, 'show');
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
                $responseToUser = $this->registerView->registerResponse($this->userFeedback::successfulRegistration);
                $this->loginView->setRegisteredUserName($registerInfo->getUserName());
                $this->layoutView->echoHtml(false, $responseToUser, 'login');
            } else {
                $responseToUser = $this->registerView->registerResponse($this->userFeedback::noFeedback);
                $this->layoutView->echoHtml(false, $responseToUser, 'register');
            }

        } catch (\Exception $e) {
            $this->registerView->setUserName($this->registerView->getRegisterUserName());
            $this->layoutView->echoHtml(false, $e->getMessage(), 'register');
        }

    }

    public function loginLogic() {

        try {
            $loginInfo = new \model\Login($this->loginView->getLoginUserName(), $this->loginView->getLoginPassword(), $this->db);
            if ($this->loginView->doesUserWantToStayLoggedIn()) {
                if ($this->cookie->isCookieSet()) {
                    $responseToUser = $this->loginView->loginResponse($this->userFeedback::noFeedback);
                    $this->layoutView->echoHtml(true, $responseToUser, 'login');
                } else {
                    $this->loginController->loginWithCookie($loginInfo);
                    $responseToUser = $this->loginView->loginResponse($this->userFeedback::welcomeRemember);
                    $this->layoutView->echoHtml(true, $responseToUser, 'login');
                }
            } else if ($this->loginController->loggedInWithSession()) {
                $responseToUser = $this->loginView->loginResponse($this->userFeedback::noFeedback);
                $this->layoutView->echoHtml(true, $responseToUser, 'login');
            } else {
                $this->loginController->login($loginInfo);
                $responseToUser = $this->loginView->loginResponse($this->userFeedback::welcomeMessage);
                $this->layoutView->echoHtml(true, $responseToUser, 'login');

            }

        } catch (\Exception $e) {
            $this->loginView->setRegisteredUserName($this->loginView->getLoginUserName());
            $this->layoutView->echoHtml(false, $e->getMessage(), 'login');
        }
    }

    public function logoutLogic() {
        if ($this->loginController->logoutResponse()) {
            $responseToUser = $this->loginView->loginResponse($this->userFeedback::bye);
            $this->layoutView->echoHtml(false, $responseToUser, 'login');
        } else {
            $responseToUser = $this->registerView->registerResponse($this->userFeedback::noFeedback);
            $this->layoutView->echoHtml(false, $responseToUser, 'login');
        }
    }

    public function StartLogic() {
        if ($this->loginController->loggedInWithCookie()) {
            $responseToUser = $this->loginView->loginResponse($this->userFeedback::welcomeCookie);
            $this->layoutView->echoHtml(true, $responseToUser, 'login');
        } else if ($this->loginController->loggedInWithSession()) {
            $responseToUser = $this->loginView->loginResponse($this->userFeedback::noFeedback);
            $this->layoutView->echoHtml(true, $responseToUser, 'login');
        } else {
            $responseToUser = $this->loginView->loginResponse($this->userFeedback::noFeedback);
            $this->layoutView->echoHtml(false, $responseToUser, 'login');
        }
    }

}
