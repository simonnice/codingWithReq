<?php

namespace view;

class RegisterView {

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $messageId = 'RegisterView::Message';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';

    private $userNameInField = false;

    public function RegisterHtmlRender($message): string {

        $response = $this->generateRegisterFormHTML($message);

        return $response;
    }

    public function generateRegisterLink(): string {
        $registerLink = '?register';
        return '
        <a href="' . $registerLink . '">Register a new user</a>
		';
    }

    /**
     * Generate HTML code on the output buffer for the register button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */

    private function generateRegisterFormHTML($message): string {

        $user;
        if ($this->userNameInField) {
            $user = $this->userNameInField;
            $user = strip_tags($user);
        } else {
            $user = '';
        }
        return '
        <h2>Register new user</h2>
            <form action="?register" form method="post">
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $message . '</p>

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" size="20" name="' . self::$name . '" id="' . self::$name . '" value="' . $user . '" />
                    <br>

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" value="" />
                    <br>

                    <label for="' . self::$passwordRepeat . '">Repeat password :</label>
                    <input type="password" size="20" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" value="" />
                    <br>

                    <input id="submit" type="submit" name="DoRegistration" value="Register" />
                </fieldset>
            </form>


            ';
    }

    public function registerLinkIsClicked(): bool {
        if (isset($_GET['register'])) {
            return true;
        } else {

            return false;
        }
    }
    public function isRegisterButtonClicked(): bool {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {

            return false;
        }
    }

    public function registerResponse($message): string {
        return $this->message = $message;
    }

    public function setUserName($userName): void {
        $this->userNameInField = $userName;
    }

    public function getRegisterUserName(): string {
        return $_POST[self::$name];
    }

    public function getRegisterPassword(): string {
        return $_POST[self::$password];
    }

    public function getRegisterRepeatedPassword(): string {
        return $_POST[self::$passwordRepeat];
    }
}
