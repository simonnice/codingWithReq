<?php
namespace view;

class LayoutView {

    public function echoHtml($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $registerView, $lc, $rc, $conn) {

        if (isset($_SESSION['loggedInUser'])) {
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }

        if ($isLoggedIn == false) {

            $isRegisterLinkClicked = $rc->checkIfRegisterIsClicked();
            if ($isRegisterLinkClicked == true) {
                $registerResponseString = $rc->checkRegisterInputs($conn);
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
                  ' . $registerView->responseRegister($isRegisterLinkClicked, $registerResponseString) . '
                  ' . $dtv->show() . '
                  </div>
                 </body>
              </html>
            ';
            } else {
                $responseValue = $lc->checkLoginCredentials($conn);
                echo '<!DOCTYPE html>
              <html>
                <head>
                  <meta charset="utf-8">
                  <title>Login Example</title>
                </head>
                <body>
                  <h1>Assignment 2</h1>
                  ' . $registerView->responseRegister($isRegisterLinkClicked, '') . '
                  ' . $this->renderIsLoggedIn($isLoggedIn) . '

                  <div class="container">
                      ' . $v->response($responseValue, $isLoggedIn) . '

                      ' . $dtv->show() . '
                  </div>
                 </body>
              </html>
            ';
            }

        } else if ($isLoggedIn == true) {
            $isLogoutButtonClicked = $lc->checkIfLogoutButtonIsClicked();
            if ($isLogoutButtonClicked == true) {
                $isLoggedIn = false;
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
                ' . $v->response('Bye bye!', $isLoggedIn) . '

                ' . $dtv->show() . '
                </div>
               </body>
            </html>
            ';
            } else {
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
                    ' . $v->response('', $isLoggedIn) . '

                    ' . $dtv->show() . '
                    </div>
                   </body>
                </html>
                ';
            }

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
