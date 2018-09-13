<?php

class DateTimeView {


	public function show() {

		$timeString = date("l");

		return '<p>' . $timeString . '</p>';
	}
}