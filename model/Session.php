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

    public function createUserSessions($user) {
        $_SESSION['user_name'] = $user->name;
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
}
