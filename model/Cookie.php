<?php

// Looking good
// 19/10-18
namespace model;

class Cookie {

    private $name;
    private $value = "";
    private $time;

    public function setCookieTime($time) {
        $date = new \DateTime();
        $date->modify($time);
        $this->time = $date->getTimeStamp();
    }

    public function setCookieName($name) {
        $this->name = $name;
    }

    public function setCookieValue($value) {
        $this->value = $value;
    }

    public function getCookieName() {
        return $this->name;
    }

    public function getCookieTime(): string {
        return $this->time;
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

    public function createCookie() {
        setCookie($this->getCookieName(), $this->getCookieValue(), $this->getCookieTime());
    }

    public function deleteCookie() {
        setCookie('user_name', '', 1);
    }

}
