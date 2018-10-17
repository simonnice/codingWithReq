<?php
namespace view;

class postView {

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

					<input type="submit" name="' . self::$submitPost . '" value="Create Post" />
				</fieldset>
			</form>
		';
    }
}
