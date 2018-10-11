<?php
namespace view;

class LoginView {
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    public function __construct() {

    }

    /**
     * Create HTTP response
     *
     * Should be called after a login attempt has been determined
     *
     * @return  void BUT writes to standard output and cookies!
     */
    public function response($isLoggedIn, $message) {

        if ($isLoggedIn) {
            $response = $this->generateLogoutButtonHTML($message);
        } else {

            $response = $this->generateloginFormHTML($message);
        }
        return $response;
    }

    public function generateLoginLink() {
        $loginLink = '?';
        return '
        <a href="' . $loginLink . '">Back to Login</a>
		';
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLogoutButtonHTML($message) {
        return '
			<form  method="post" form action="?" >
				<p id="' . self::$messageId . '">' . $message . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLoginFormHTML($message) {
        return '
			<form method="post" form action="?">
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . (isset($_POST[self::$name]) ? $_POST[self::$name] : "") . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }

    public function getLoginUserName() {
        return $_POST[self::$name];
    }

    public function getLoginPassword() {
        return $_POST[self::$password];
    }

    public function isLoginButtonClicked() {
        if (isset($_POST[self::$login])) {
            return true;
        } else {

            return false;
        }
    }

    public function doesUserWantToStayLoggedIn() {
        if (isset($_POST[self::$keep])) {
            return true;
        } else {

            return false;
        }
    }

    public function isLogoutButtonClicked() {
        if (isset($_POST[self::$logout])) {
            return true;
        } else {

            return false;
        }
    }

    public function returnedStringToOutput($message) {
        $this->message = $message;
    }

    //CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
    private function getRequestUserName() {
        //RETURN REQUEST VARIABLE: USERNAME
    }

}
