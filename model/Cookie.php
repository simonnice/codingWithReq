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

    public function setTime($time) {
      $date = new DateTime();
      $date->modify($time);
      $this->time = $date->getTimeStamp();
    }




}
