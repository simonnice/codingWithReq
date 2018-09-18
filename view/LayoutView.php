<?php
namespace view;

class LayoutView {

    public function echoHtml($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $registerView, $lc, $rc) {

        if ($isLoggedIn == false) {

            $isRegisterLinkClicked = $rc->checkIfRegisterIsClicked();
            if ($isRegisterLinkClicked == true) {
                echo '<!DOCTYPE html>
              <html>
                <head>
                  <meta charset="utf-8">
                  <title>Login Example</title>
                </head>
                <body>
                  <h1>Assignment 2</h1>
                  ' . $this->renderIsLoggedIn($isLoggedIn) . '

                  <div class="container">
                  ' . $registerView->echoRegisterHtml($isRegisterLinkClicked) . '

                      ' . $dtv->show() . '
                  </div>
                 </body>
              </html>
            ';
            } else {
                $responseValue = $lc->checkLoginCredentials();
                echo '<!DOCTYPE html>
              <html>
                <head>
                  <meta charset="utf-8">
                  <title>Login Example</title>
                </head>
                <body>
                  <h1>Assignment 2</h1>
                  ' . $registerView->echoRegisterHtml('') . '
                  ' . $this->renderIsLoggedIn($isLoggedIn) . '

                  <div class="container">
                      ' . $v->response($responseValue) . '

                      ' . $dtv->show() . '
                  </div>
                 </body>
              </html>
            ';
            }

        } else if ($isLoggedIn == true) {
            echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <title>Login Example</title>
              </head>
              <body>
                <h1>Assignment 2</h1>
                ' . $this->renderIsLoggedIn($isLoggedIn) . '
                    <p>Welcome</p>
                <div class="container">
                <input type="submit" id="submit" name="' . self::$logout . '" value="logout" />

                    ' . $dtv->show() . '
                </div>
               </body>
            </html>
            ';
        }

    }

    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
        }
    }
}
