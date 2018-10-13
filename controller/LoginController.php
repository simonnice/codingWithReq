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
            $this->session->createUserSession($loginInfo->getUserName());
        }
    }
    

    public function loggedInWithSession(){
        if ($this->session->isSessionSet()) {
           return true;
        }else {
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

    public keepUserLoggedIn(): bool {
        if($loginView->doesUserWantToStayLoggedIn()) {
            return true;
        } else {
            return false;
        }
    }

    // if ($this->keepUserLoggedIn() {
    //     $this->cookie->setCookieName($loginInfo->getUserName());
    //     $this->cookie->setCookieValue($loginInfo->getUserName());
    //     $this->cookie->setTime("+1 hour");
    //     $this->cookie->createCookie();
    // })

}
