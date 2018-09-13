<?php

class DateTimeView {


	public function show() {

		$timeString = date('l jS \of F Y  h:i:s');
		

		return '<p>' . $timeString . '</p>';
	}
}