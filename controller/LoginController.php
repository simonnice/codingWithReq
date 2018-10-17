<?php
namespace controller;

class LoginController {

    private $loginView;
    private $db;
    private $session;
    private $cookie;

    public function __construct($login, $db, $session, $cookie) {
        $this->loginView = $login;
        $this->db = $db;
        $this->session = $session;
        $this->cookie = $cookie;
    }

    public function login($loginInfo) {
        if (!$this->session->isSessionSet()) {
            $this->session->createUserSession($loginInfo->getUserName(), $loginInfo->getUserId());
        }
    }

    public function loginWithCookie($loginInfo) {

        $this->cookie->setCookieName('user_name');
        $this->cookie->setCookieValue($loginInfo->getUserName());
        $this->cookie->setCookieTime("+1 hour");
        $this->cookie->createCookie();

    }

    public function loggedInWithSession() {
        if ($this->session->isSessionSet()) {
            return true;
        } else {
            return false;
        }
    }

    public function loggedInWithCookie() {
        if ($this->cookie->isCookieSet()) {
            return true;
        } else {
            return false;
        }
    }

    public function logoutUser() {
        if ($this->session->isSessionSet()) {
            $this->session->destroyCurrentSession();
            return true;
        } else {
            return false;
        }
    }

    public function logoutResponse() {
        $response = $this->logoutUser();
        if ($response) {
            return true;
        } else {
            return false;
        }

    }

    public function isLoggedIn() {
        if ($this->session->isSessionSet()) {
            return true;
        } else {
            return false;
        }
    }

    public function keepUserLoggedIn(): bool {
        if ($this->loginView->doesUserWantToStayLoggedIn()) {
            return true;
        } else {
            return false;
        }
    }

}
