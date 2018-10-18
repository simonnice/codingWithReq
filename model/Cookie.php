<?php

namespace model;

class Cookie {

    private $name;
    private $value = "";
    private $time;

    public function __construct() {

    }

    public function createCookie(): bool {
        return setCookie($this->getCookieName(), $this->getCookieValue(), $this->getCookieTime());
    }

    public function deleteCookie(): bool {
        return setCookie($this->name, '', time() - 3600);
    }

    public function setCookieName($name): string {
        $this->name = $name;
    }

    public function getCookieName(): string {
        return $this->name;
    }

    public function setCookieTime($time) {
        $date = new \DateTime();
        $date->modify($time);
        $this->time = $date->getTimeStamp();
    }

    public function getCookieTime(): string {
        return $this->time;
    }

    public function setCookieValue($value): string {
        $this->value = $value;
    }

    public function getCookieValue(): string {
        return $this->value;
    }

    public function isCookieSet(): bool {
        if (isset($_COOKIE['user_name'])) {
            return true;
        } else {
            return false;
        }

    }

}
