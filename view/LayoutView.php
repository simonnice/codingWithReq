<?php
namespace view;

class LayoutView {

    public function echoHtml($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $registerView, $lc, $rc, $conn) {

        if ($isLoggedIn == false) {

            $isRegisterLinkClicked = $rc->checkIfRegisterIsClicked();
            if ($isRegisterLinkClicked == true) {
                $registerResponseValue = $rc->checkRegisterInputs($conn);
                echo '<!DOCTYPE html>
              <html>
                <head>
                  <meta charset="utf-8">
                  <title>Login Example</title>
                </head>
                <body>
                  <h1>Assignment 2</h1>
                  <a href="?">Back to login</a>
                  ' . $this->renderIsLoggedIn($isLoggedIn) . '

                  <div class="container">
                  ' . $registerView->echoRegisterHtml($isRegisterLinkClicked, $registerResponseValue) . '
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
                  ' . $registerView->echoRegisterHtml($isRegisterLinkClicked, '') . '
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

// Small test to test filter_has_var function for checking input on submitbutton
/*if (filter_has_var(INPUT_POST, 'DoRegistration')) {
echo 'Registered';
}*/

// Small test to test isset on the value of the submit button in RegisterView
/*if (isset($_POST['DoRegistration'])) {
header('Location: index.php'); // Testing header redirect on submission // Brad Traversy Part 16
}*/
