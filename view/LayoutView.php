<?php
namespace view;

class LayoutView {

    public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, $lc) {

        $responseValue = $lc->checkLoginCredentials();

        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          <a href="register.php"> Register a new user</a>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' . $v->response($responseValue) . '

              ' . $dtv->show() . '
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
