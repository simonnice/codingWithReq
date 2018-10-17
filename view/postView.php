<?php
namespace view;

class postView {

    private static $title = 'postView::title';
    private static $body = 'postView::body';
    private static $createPost = 'postView::createPost';

    private $sessionToRead;

    public __construct($session) {
      $this->sessionToRead = $session;
    }

    private function generatePostFormHtml() {
        return '
			<form method="post" form action="posts">
				<fieldset>
					<legend>Write a new post here!</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$title . '">Title :</label>
					<input type="text" id="' . self::$title . '" name="' . self::$title . '" value="" />

					<label for="' . self::$body . '">Body :</label>
          <textarea id="' . self::$body . '" name="' . self::$body . '" />

					<input type="submit" name="' . self::$createPost . '" value="Create Post" />
				</fieldset>
			</form>
		';
    }

    public function isCreatePostButtonClicked() {
        if (isset($_POST[self::$createPost])) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostTitle() {
        return $_POST[self::$title];
    }

    public function getPostBody() {
        return $_POST[self::$body];
    }

    public function getActiveUser() {
        $this->sessionToRead->getCurrentUser();
    }
}
