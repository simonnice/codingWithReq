<?php

namespace model;

class Session {

    private $sessionId;

    public function __construct() {
        if (!isset($_SESSION)) {
            $this->startSession();
        }
    }

    public function startSession() {
        session_start();
    }

    public function createUserSession($userName, $userId) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $userName;
    }

    public function destroyCurrentSession() {
        session_unset();
        session_destroy();
    }

    public function isSessionSet() {
        if (isset($_SESSION['user_name'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUserId() {
        return $_SESSION['user_id'];
    }
}
