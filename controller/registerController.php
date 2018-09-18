<?php

namespace controller;

class registerController {

    private $state;
    private $registerView;

    public function __construct($state, $register) {
        $this->state = $state;
        $this->registerView = $register;
    }

    /**
     * Handle a GET request to Register.php
     *
     */

    public function checkIfRegisterIsClicked() {
        if ($this->registerView->registerLinkIsClicked() == true) {

            return true;
        }

    }

}
