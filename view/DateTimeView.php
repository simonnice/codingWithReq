<?php

class DateTimeView {


	public function show() {

		$timeStringDay = date('l');
		$timeStringDate = date('jS');
		$timeStringMonth = date('F');
		$timeStringYear = date('Y');

		//  jS \of F Y h:i:s

		return '<p>' . $timeString . '</p>';
	}
}