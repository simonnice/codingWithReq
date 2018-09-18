<?php

namespace controller;

class registerController {

    private $state;
    private $registerView;

    public function __construct($register) {
        // $this->state = $state;
        $this->registerView = $register;
    }

    /**
     * Handle a GET request to Register.php
     *
     */

    public function checkClick() {
        if ($this->registerView->registerLinkIsClicked() == true) {

            return true;
        }

    }

}
