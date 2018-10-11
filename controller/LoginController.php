<?php
namespace controller;

class LoginController {

    private $loginView;
    private $db;
    private $session;

    public function __construct($login, $db, $session) {
        $this->loginView = $login;
        $this->db = $db;
        $this->session = $session;
    }

    public function loginStatus($loginInfo) {
        if (!$this->session->isSessionSet()) {
            $this->session->createUserSession($loginInfo->getUserName());
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

}
