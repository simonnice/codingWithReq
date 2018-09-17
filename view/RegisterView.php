<?php

namespace view;

class RegisterView {

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';

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
     }
}
