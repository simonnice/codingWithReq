<?php

namespace controller;

class MainController {

    public function loadView($view, $data = []) {
        require_once 'view/' . $view . '.php';
    }
}
