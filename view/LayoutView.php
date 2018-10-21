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

    public function generateSpecificViewHtml($view, $msg, $isLoggedIn): string {
        if ($view == "login") {
            return $this->loginView->generateLoginHtml($isLoggedIn, $msg);
        } else if ($view == "register") {
            return $this->registerView->generateRegisterHtml($msg);
        } else if ($view == "post") {
            return $this->postView->generatePostHtml($msg);
        } else if ($view == "show") {
            return $this->postView->generateShowPostHtml($msg);
        }
    }

    public function generateSpecificLinkHtml($view, $isLoggedIn): string {
        if ($view == 'login' && $isLoggedIn == true) {
            return $this->postView->generatePostLinks();
        } else if ($view == 'login') {
            return $this->registerView->generateRegisterLink();
        } else {
            return $this->loginView->generateLoginLink();
        }
    }

    public function echoHtml($isLoggedIn, $msg, $view): void {

        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->generateSpecificLinkHtml($view, $isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' . $this->generateSpecificViewHtml($view, $msg, $isLoggedIn) . '
              ' . $this->dateTimeView->show() . '
          </div>
         </body>
      </html>
    ';
    }

    private function renderIsLoggedIn($isLoggedIn): string {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
        }
    }
}
