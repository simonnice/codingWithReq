<?php
namespace view;

class PostView {

    private static $title = 'postView::title';
    private static $body = 'postView::body';
    private static $createPost = 'postView::createPost';
    private static $messageId = 'postView::messageId';

    private $sessionToRead;

    public function __construct($session) {
        $this->sessionToRead = $session;
    }

    public function generatePostLinks() {
        $postLink = '?post';
        $showLink = '?show';
        return '
      <a href="' . $postLink . '">Create a new post</a>
      <a href="' . $showLink . '">Show all your posts</a>
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

    public function generateShowPostHtml($list) {

        return '
        <h1>Here are your posts!</h1>
        ' . $this->generateListOfPosts($list) . '

     ';
    }

    public function generateListOfPosts($data) {
        $list = '';
        foreach ($data as $post) {
            $list .= '<hr>
                      <h3> ' . $post->title . ' </h3>
                      <p>  ' . $post->body . ' </p>
                      <p>Posted at : <i>  ' . $post->created_at . ' </i></p>
                      <hr>

            ';
        }
        return $list;
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

    public function isShowPostsLinkClicked() {
        if (isset($_GET['show'])) {
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

    public function getActiveUserId() {
        return $this->sessionToRead->getCurrentUserId();
    }

}
