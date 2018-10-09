<?php
namespace controller;

class UserController extends MainController {

    private $registerView;
    private $loginView;
    private $user;

    public function __construct($register, $login, $User) {
        $this->registerView = $register;
        $this->loginView = $login;
        $this->user = $User;
    }

    // Cleans up input from register form and returns it
    public function registerInputResponse() {

        $sanitizedName = filter_var($this->registerView->getRegisterUserName(), FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($this->registerView->getRegisterPassword(), FILTER_SANITIZE_STRING);
        $sanitizedRepeatPassword = filter_var($this->registerView->getRegisterRepeatedPassword(), FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($sanitizedName),
            'password' => trim($sanitizedPassword),
            'confirm_password' => trim($sanitizedRepeatPassword),
            'name_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
        ];

        return $data;

    }

    // returns the response from validation in User Model

    public function validatetRegisterFormData($data) {
        return $validatedRegisterInput = $this->user->validateRegisterInputInForm($data);
    }

    // Returns a boolean to determine if registration was successful or not

    public function registerResponseFromDatabase() {

        if ($this->registerView->isRegisterButtonClicked()) {

            $registerInput = $this->registerInputResponse();
            $validatedData = $this->validatetRegisterFormData($registerInput);

            if (empty($validatedData['name_err']) && empty($validatedData['password_err']) && empty($validatedData['confirm_password_err'])) {
                $this->user->registerNewUser($validatedData);
                return $validatedData;
            } else {

                return $this->produceErrorArray($validatedData);
            }

        } else {

            // Init data
            $data = [
                'name' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            return $data;
        }
    }

    public function loginInputResponse() {
        $sanitizedName = filter_var($this->loginView->getLoginUserName(), FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($this->loginView->getLoginPassword(), FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($sanitizedName),
            'password' => trim($sanitizedPassword),
            'name_err' => '',
            'password_err' => '',
        ];

        return $data;
    }

    public function validatedLoginFormData($data) {
        return $validatedLoginInput = $this->user->validateLoginInputInForm($data);
    }

    // TODO - MUST FIX VALIDATION OF THE ACTUAL USER IN DB, BOTH NAME AND PASSWORD BEFORE REGISTERING
    // IT IS POSSIBLE SINCE USER HAS A DB-CONNECTION, YOU CAN DO THIS IN
    // VALIDATEDLOGINFORMDATA

    public function loginResponseFromDatabase() {

        $loginInput = $this->loginInputResponse();
        $validatedData = $this->validatedLoginFormData($loginInput);

        if (empty($validatedData['name_err']) && empty($validatedData['password_err'])) {
            $isLoggedIn = $this->user->loginUser($validatedData['name'], $validatedData['password']);

            if ($isLoggedIn) {
                // Session Handling.
                $this->createUserSessions($isLoggedIn);
                return $validatedData;
            } else {
                $validatedData['password_err'] = "Wrong name or password";
                return $this->produceErrorArray($validatedData);
            }
        } else {
            return $this->produceErrorArray($validatedData);
        }

    }

    public function produceErrorArray($arrayToFilter) {
        $errorArray = array();
        foreach ($arrayToFilter as $key => $value) {
            if ($key == "name_err") {
                array_push($errorArray, $value);
            }

            if ($key == "password_err") {
                array_push($errorArray, $value);
            }
        }
        return $errorArray;
    }

}
