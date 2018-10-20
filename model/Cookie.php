<?php

// Looking good
// 19/10-18
namespace model;

class Cookie {

    private $name;
    private $value = "";
    private $time;

    public function createCookie() {
        \setcookie($this->getCookieName(), $this->getCookieValue(), $this->getCookieTime());
    }

    public function deleteCookie() {
        \setcookie('user_name', '', 1);
    }

    public function setCookieName($name) {
        $this->name = $name;
    }

    public function getCookieName() {
        return 'user_name';
    }

    public function setCookieTime($time) {
        $date = new \DateTime();
        $date->modify($time);
        $this->time = $date->getTimeStamp();
    }

    public function getCookieTime(): string {
        return $this->time;
    }

    public function setCookieValue($value) {
        $this->value = $value;
    }

    public function getCookieValue() {
        return $this->value;
    }

    public function isCookieSet() {
        if (isset($_COOKIE['user_name'])) {
            return true;
        } else {
            return false;
        }

    }

}
