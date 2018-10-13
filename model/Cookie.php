<?php

namespace model;

class Cookie {

    private $name;
    private $value = "";
    private $time;

    public function __construct() {

    }

    public function createCookie() {
      return setCookie($this->name, $this->getValue())
    }

    public function setCookieName($name) {
      $this->name = $name;
    }

    public function getCookieName() {
      return $this->name;
    }




}
