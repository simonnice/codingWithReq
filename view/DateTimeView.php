<?php

class DateTimeView {


	public function show() {

		$timeString = date('l jS \of F Y  h:i:s');
		echo "Hej";
		

		return '<p>' . $timeString . '</p>';
	}
}