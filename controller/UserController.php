<?php
namespace controller;

class UserController extends MainController {

    private $loginView;
    private $user;
    private $session;

    public function __construct($login, $user, $session) {
        $this->loginView = $login;
        $this->user = $user;
        $this->session = $session;
    }

    public function loginInputResponse() {
        $sanitizedName = filter_var($this->loginView->getLoginUserName(), FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($this->loginView->getLoginPassword(), FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($sanitizedName),
            'password' => trim($sanitizedPassword),
            'db_msg' => '',
            'name_err' => '',
            'password_err' => '',
            'db_err' => '',
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

        if (empty($validatedData['name_err']) && empty($validatedData['password_err']) && empty($validatedData['db_err'])) {
            $this->user->loginUser($validatedData['name']);
            return true;

        } else {
            return $this->user->generateErrorResponseToView($validatedData);
        }

    }

    public function logoutResponse() {
        $response = $this->user->logoutUser();
        return $this->user->generateSuccessResponseToView($response);

    }

    public function isLoggedIn() {
        if ($this->session->isSessionSet()) {
            return true;
        } else {
            return false;
        }
    }

}
