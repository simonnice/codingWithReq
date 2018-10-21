<?php

namespace view;

class LoginView {

    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $post = 'LoginView::Post';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    private $userNameInField = false;

    public function generateLoginHtml($isLoggedIn, $message): string {

        if ($isLoggedIn) {
            $response = $this->generateLoggedInFormHtml($message);
        } else {

            $response = $this->generateloginFormHTML($message);
        }
        return $response;
    }

    public function generateLoginLink(): string {
        $loginLink = '?';
        return '
        <a href="' . $loginLink . '">Back to login</a>
		';
    }

    private function generateLoggedInFormHtml($message): string {
        return '
			<form  method="post" form action="?" >
                <p id="' . self::$messageId . '">' . $message . '</p>
                <input type="submit" name="' . self::$logout . '"
                 value="logout"/>

			</form>
		';
    }

    private function generateLoginFormHTML($message): string {
        $user;

        if ($this->userNameInField) {
            $user = $this->userNameInField;
        } else if (isset($_POST[self::$name])) {
            $user = $this->getLoginUserName();
        } else {
            $user = '';
        }

        return '
			<form method="post" form action="?">
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $user . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }

    public function setRegisteredUserName($userName): void {
        $this->userNameInField = $userName;
    }

    public function getLoginUserName(): string {
        return $_POST[self::$name];
    }

    public function getLoginPassword(): string {
        return $_POST[self::$password];
    }

    public function isLoginButtonClicked(): bool {
        if (isset($_POST[self::$login])) {
            return true;
        } else {

            return false;
        }
    }

    public function doesUserWantToStayLoggedIn(): bool {
        if (isset($_POST[self::$keep])) {
            return true;
        } else {

            return false;
        }
    }

    public function isLogoutButtonClicked(): bool {
        if (isset($_POST[self::$logout])) {
            return true;
        } else {

            return false;
        }
    }

    public function loginResponse($message): string {
        return $this->message = $message;
    }

}
