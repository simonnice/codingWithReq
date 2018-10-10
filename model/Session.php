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
}
