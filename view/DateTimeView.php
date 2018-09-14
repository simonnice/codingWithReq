<?php

class DateTimeView {


	public function show() {

		$timeString = // $timeString = date('l jS \of F Y \,  h:i:s');
		$timeString = date('l');
		$timeString .=", the " . date('jS');
				

		return '<p>' . $timeString .  '</p>';
	}
}