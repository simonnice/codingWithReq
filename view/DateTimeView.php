<?php

class DateTimeView {


	public function show() {

		$timeString = date("1");

		return '<p>' . $timeString . '</p>';
	}
}