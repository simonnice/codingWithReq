<?php

namespace controller;

class RegisterController {

    private $registerView;
    private $session;
    private $message;
    private $db;

    public function __construct($registerView, $session, $message, $db) {
        $this->registerView = $registerView;
        $this->session = $session;
        $this->message = $message;
        $this->db = $db;

    }

    // Cleans up input from register form and returns it
    public function registerInputResponse() {

        $sanitizedName = filter_var($this->registerView->getRegisterUserName(), FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($this->registerView->getRegisterPassword(), FILTER_SANITIZE_STRING);
        $sanitizedRepeatPassword = filter_var($this->registerView->getRegisterRepeatedPassword(), FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($sanitizedName),
            'password' => trim($sanitizedPassword),
            'confirm_password' => trim($sanitizedRepeatPassword),
        ];

        return $data;

    }

    public function registerResponseFromDatabase($registerinfo) {

        $this->db->registerNewUser($registerinfo);

    }

}
