<?php

namespace model;

class Cookie {

    private $name;
    private $value = "";
    private $time;

    public function setCookieTime($time): void {
        $date = new \DateTime();
        $date->modify($time);
        $this->time = $date->getTimeStamp();
    }

    public function setCookieName($name): void {
        $this->name = $name;
    }

    public function setCookieValue($value): void {
        $this->value = $value;
    }

    public function getCookieName(): string {
        return $this->name;
    }

    public function getCookieTime(): string {
        return $this->time;
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

    public function createCookie(): void {
        setCookie($this->getCookieName(), $this->getCookieValue(), $this->getCookieTime());
    }

    public function deleteCookie(): void {
        setCookie('user_name', '', 1);
    }

}
