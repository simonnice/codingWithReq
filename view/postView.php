<?php
namespace view;

class PostView {

    private static $title = 'postView::title';
    private static $body = 'postView::body';
    private static $createPost = 'postView::createPost';
    private static $messageId = 'postView::messageId';
    private static $deletePost = 'postView::deletePost';
    private static $postId = 'postView::postId';

    private $sessionToRead;

    public function __construct($session) {
        $this->sessionToRead = $session;
    }

    public function generatePostLinks(): string {
        $postLink = '?post';
        $showLink = '?show';
        return '
      <a href="' . $postLink . '">Create a new post</a>
      <a href="' . $showLink . '">Show all your posts</a>
  ';
    }

    public function postHtmlRender($message): string {

        $response = $this->generatePostFormHtml($message);

        return $response;
    }

    public function generatePostFormHtml($message): string {
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

    public function generateShowPostHtml($list): string {

        return '
        <h1>Here are your posts!</h1>

        ' . $this->generateListOfPosts($list) . '

     ';
    }

    public function generateListOfPosts($data): string {
        $list = '';
        $deletePost = '?delete';
        foreach ($data as $post) {
            $list .= '<hr>
                    <form method="post" form action="?delete">
                      <input type="hidden" name="id" value=" ' . $post->id . '" />
                      <h3> ' . $post->title . ' </h3>
                      <p>  ' . $post->body . ' </p>
                      <input type="submit" name="deletePost" value="Delete post" />
                      <p>Posted at : <i>  ' . $post->created_at . ' </i></p>
                      <hr>
                      </form>
            ';
        }
        return $list;
    }

    public function isCreatePostButtonClicked(): bool {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public function isCreatePostLinkClicked(): bool {
        if (isset($_GET['post'])) {
            return true;
        } else {

            return false;
        }
    }

    public function isDeleteLinkClicked(): bool {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    public function isShowPostsLinkClicked(): bool {
        if (isset($_GET['show'])) {
            return true;
        } else {

            return false;
        }
    }

    public function postResponse($message): string {
        return $this->message = $message;
    }

    public function getPostTitle(): string {
        return $_POST[self::$title];
    }

    public function getPostBody(): string {
        return $_POST[self::$body];
    }

    public function getPostId(): int {
        return $_POST['id'];
    }

    public function getActiveUserId(): int {
        return $this->sessionToRead->getCurrentUserId();
    }

}
