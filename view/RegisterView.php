<?php

namespace view;

class RegisterView {

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $messageId = 'RegisterView::message'

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
                    
                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name"' . self::$name . '" value="" />

                    <label for="' . self::$password . '">Password :</label>
                    <input type="text" id="' . self::$password . '" name"' . self::$password . '" />

                    <
                    '
     }
}
