<?php

class DateTimeView {


	public function show() {

		$timeString = date('l jS \of F Y\, \the \time \is h:i:s');
		

		return '<p>' . $timeString . '</p>';
	}
}