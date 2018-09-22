<?php

namespace view;

class RegisterView {
    // derp

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $messageId = 'RegisterView::Message';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';

    public function echoRegisterHtml($registerLinkIsClicked, $message) {

        if ($registerLinkIsClicked == false) {
            $response = $this->generateRegisterLink();
        } else {
            $response = $this->generateRegisterFormHTML($message);
        }

        //$response .= $this->generateLogoutButtonHTML($message);
        return $response;
    }

    public function generateRegisterLink() {
        $registerLink = '?register';
        return '
        <a href="' . $registerLink . '">Register a new user</a>
		';
    }
    // <a href="register.php" id="' . self::$register . '"> Register a new user</a>
    /**
     * Generate HTML code on the output buffer for the register button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */

    private function generateRegisterFormHTML($message) {
        return '
        <h2>Register new user</h2>
            <form action ="?register" form method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $message . '</p>

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" size="20" name="' . self::$name . '" id="' . self::$name . '" value="' . (isset($_POST[self::$name]) ? $_POST[self::$name] : "") . '" />
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

    // RegisterView::Register=Register &RegisterView::UserName= &RegisterView::Password= &RegisterView::PasswordRepeat=

    public function registerLinkIsClicked() {
        if (isset($_GET['register'])) {
            return true;
        } else {

            return false;
        }
    }

    public function isRegisterButtonClicked() {
        if (isset($_POST['DoRegistration'])) {
            return true;
        } else {

            return false;
        }
    }

    public function getRegisterFormData() {
        return $_POST;
    }
}
