<?php

namespace view;

class RegisterView {

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $messageId = 'RegisterView::message';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';

    public function responseReg($bool) {

        if ($bool == false) {
            $response = $this->generateRegisterLink();
        } else {
            $response = $this->generateRegisterFormHTML('');
        }

        //$response .= $this->generateLogoutButtonHTML($message);
        return $response;
    }

    public function generateRegisterLink() {
        return '
        <form method="post">
          <fieldset>
            <input type="submit" id="submit" name="' . self::$register . '" value="register" />
          </fieldset>
        </form>

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
            <form method="post">
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $message . '</p>
                    <br>

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name"' . self::$name . '" value="" />
                    <br>

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" id="' . self::$password . '" name"' . self::$password . '" />
                    <br>

                    <label for="' . self::$passwordRepeat . '">Repeat password :</label>
                    <input type="password" id="' . self::$passwordRepeat . '" name"' . self::$passwordRepeat . '" />
                    <br>

                    <input type="submit" id="submit" name="' . self::$register . '" value="Register" />
                </fieldset>
            </form>

            ';
    }

    public function registerLinkIsClicked() {
        if (isset($_GET['RegisterView::Register'])) {
            return true;
        } else {

            return false;
        }
    }
}
