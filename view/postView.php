<?php
namespace view;

class postView {

    private static $title = 'postView::title';
    private static $body = 'postView::body';
    private static $createPost = 'postView::createPost';
    private static $messageId = 'postView::messageId';

    private $sessionToRead;

    public function __construct($session) {
        $this->sessionToRead = $session;
    }

    public function generatePostLink() {
        $postLink = '?post';
        return '
      <a href="' . $postLink . '">Create a new post</a>
  ';
    }

    public function postHtmlRender($message) {

        $response = $this->generatePostFormHtml($message);

        return $response;
    }

    public function generatePostFormHtml($message) {
        return '
			<form method="post" form action="?post">
				<fieldset>
					<legend>Write a new post here!</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$title . '">Title :</label>
					<input type="text" id="' . self::$title . '" name="' . self::$title . '" value="" />

					<label for="' . self::$body . '">Body :</label>
          <input type="text" id="' . self::$body . '" name="' . self::$body . '" value="" />

					<input type="submit" name="' . self::$createPost . '" value="Create Post" />
				</fieldset>
			</form>
		';
    }

    public function isCreatePostButtonClicked() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public function isCreatePostLinkClicked() {
        if (isset($_GET['post'])) {
            return true;
        } else {

            return false;
        }
    }

    public function postResponse($message) {
        return $this->message = $message;
    }

    public function getPostTitle() {
        return $_POST[self::$title];
    }

    public function getPostBody() {
        return $_POST[self::$body];
    }

    public function getActiveUser() {
        return $this->sessionToRead->getCurrentUserId();
    }
}