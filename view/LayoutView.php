<?php
namespace view;

class LayoutView {

    public function echoHtml($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $registerView, $lc, $rc) {

        if (isset($_SESSION['loggedInUser'])) {
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }

        if ($isLoggedIn == false) {

            $isRegisterLinkClicked = $rc->checkIfRegisterIsClicked();
            if ($isRegisterLinkClicked == true) {
                $isValidRegisterInputs = $rc->checkRegisterInputs();

                if ($isValidRegisterInputs === true) {
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
                        ' . $v->response('Registered new user.', $isLoggedIn) . '
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
                        <a href="?">Back to login</a>
                        ' . $this->renderIsLoggedIn($isLoggedIn) . '

                        <div class="container">
                        ' . $registerView->responseRegister($isRegisterLinkClicked, $isValidRegisterInputs) . '
                        ' . $dtv->show() . '
                        </div>
                       </body>
                    </html>
                  ';
                }

            } else {
                $loginStatusArray = $lc->checkLoginCredentials();

                if (current($loginStatusArray) === true) {
                    $isLoggedIn = true;
                    if (next($loginStatusArray) === true) {
                        $welcomeString = 'Welcome and you will be remembered';
                    } else {
                        $welcomeString = 'Welcome';
                    }
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
                            ' . $v->response($welcomeString, $isLoggedIn) . '

                            ' . $dtv->show() . '
                        </div>
                       </body>
                    </html>
                  ';
                } else {
                    $isLoggedIn = false;
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
                            ' . $v->response($loginStatusArray, $isLoggedIn) . '

                            ' . $dtv->show() . '
                        </div>
                       </body>
                    </html>
                  ';
                }

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
                ' . $registerView->responseRegister(false, '') . '
                ' . $this->renderIsLoggedIn($isLoggedIn) . '

                <div class="container">
                ' . $v->response('Bye bye!', $isLoggedIn) . '

                ' . $dtv->show() . '
                </div>
               </body>
            </html>
            ';
            } else {
                if (isset($_COOKIE['username'])) {
                    $welcomeString = 'Welcome back with cookie';
                } else {
                    $welcomeString = 'Welcome';
                }
                echo '<!DOCTYPE html>
                <html>
                  <head>
                    <meta charset="utf-8">
                    <title>Login Example</title>
                  </head>
                  <body>
                    <h1>Assignment 2</h1>
                    ' . $this->renderIsLoggedIn($isLoggedIn) . '
                        <p>' . $welcomeString . '</p>
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
