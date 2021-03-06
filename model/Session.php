<?php

namespace model;

class Session {

    public function __construct() {
        if (!isset($_SESSION)) {
            $this->startSession();
        }
    }

    public function startSession(): void {
        session_start();
    }

    public function createUserSession($userName, $userId): void {
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $userName;
    }

    public function destroyCurrentSession(): void {
        session_unset();
        session_destroy();
    }

    public function isSessionSet(): bool {
        if (isset($_SESSION['user_name'])) {
            return true;
        } else {
            return false;
        }
    }

    public function isNotActiveUser(): bool {
        if (!isset($_SESSION['user_name'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUserId(): string {
        return $_SESSION['user_id'];
    }

    public function getCurrentUser(): string {
        return $_SESSION['user_name'];
    }
}
