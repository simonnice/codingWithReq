<?php

namespace model;

class RegisterState {

    public function ValidateRegisterInputData($data) {

        $sanitizedName = filter_var($data['RegisterView::UserName'], FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($data['RegisterView::Password'], FILTER_SANITIZE_STRING);

    }
}
