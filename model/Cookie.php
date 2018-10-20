<?php

// Looking good
// 19/10-18
namespace model;

class Cookie {

    private $name;
    private $value = "";
    private $time;

    public function createCookie(): void {
        setCookie($this->getCookieName('user_name'), $this->getCookieValue(), $this->getCookieTime());
    }

    public function deleteCookie(): void {
        setCookie('user_name', '', 1);
    }

    public function setCookieName($name): void {
        $this->name = $name;
    }

    public function getCookieName($inputtedName): string {
        return $inputtedName;
    }

    public function setCookieTime($time): void {
        $date = new \DateTime();
        $date->modify($time);
        $this->time = $date->getTimeStamp();
    }

    public function getCookieTime(): string {
        return $this->time;
    }

    public function setCookieValue($value): void {
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
