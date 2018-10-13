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

    public function setCookieTime($time) {
      $date = new DateTime();
      $date->modify($time);
      $this->time = $date->getTimeStamp();
    }

    public function getCookieTime() {
      return $this->time;
    }

    public function setCookieValue($value) {
      $this->value = $value;
    }

    public function getCookieValue() {
      return $this->value;
    }




}
