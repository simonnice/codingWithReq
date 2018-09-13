<?php

class DateTimeView {


	public function show() {

		$timeStringDay = date('l');
		$timeStringDate = date('jS');
		$timeStringMonth = date('F');
		$timeStringYear = date('Y');
		$timeStringTime = date('h:i:s');

		//  jS \of F Y h:i:s

		return '<p>'" . $timeStringDay ., the . $timeStringDate . of . $timeStringMonth . . $timeStringYear ., The time is . $timeStringTime . " '</p>';
	}
}