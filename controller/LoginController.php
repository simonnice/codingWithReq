<?php
namespace controller;

class LoginController {

    private $loginView;
    private $session;
    private $cookie;

    public function __construct($login, $session, $cookie) {
        $this->loginView = $login;
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
        echo $this->cookie->getCookieName();
        $this->cookie->setCookieValue($loginInfo->getUserName());
        $this->cookie->setCookieTime("+1 hour");
        $this->cookie->createCookie();

        $this->login($loginInfo);

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
            if ($this->cookie->isCookieSet()) {
                $this->cookie->deleteCookie();
            }
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

}
