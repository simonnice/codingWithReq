<?php

class DateTimeView {


	public function show() {

		$timeString = date('l jS \of F Y h:i:s A');
		

		return '<p>' . $timeString . '</p>';
	}
}