<?php
namespace view;

class LayoutView {
    private $dateTimeView;
    private $loginView;
    private $registerView;
    private $postView;

    public function __construct($dateTime, $login, $register, $post) {
        $this->dateTimeView = $dateTime;
        $this->loginView = $login;
        $this->registerView = $register;
        $this->postView = $post;
    }

    public function viewLoader($view, $msg, $isLoggedIn) {
        if ($view == "login") {
            return $this->loginView->response($isLoggedIn, $msg);
        } else if ($view == "register") {
            return $this->registerView->responseRegister($msg);
        } else if ($view == "post") {
            return $this->postView->generatePostFormHtml($msg);
        }
    }

    public function linkLoader($view, $isLoggedIn) {

        if ($view == 'login' && $isLoggedIn == true) {
            return;
        } else if ($view == 'login') {
            return $this->registerView->generateRegisterLink();
        } else {
            return $this->loginView->generateLoginLink();
        }
    }

    public function echoHtml($isLoggedIn, $msg, $view) {

        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->linkLoader($view, $isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' . $this->viewLoader($view, $msg, $isLoggedIn) . '
              ' . $this->dateTimeView->show() . '
          </div>
         </body>
      </html>
    ';
    }

    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
        }
    }
}
