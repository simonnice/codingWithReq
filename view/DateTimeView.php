<?php

class DateTimeView {


	public function show() {

		$timeString = // $timeString = date('l jS \of F Y \,  h:i:s');
		$timeString = date('l');
		$timeString .=", the " . date('jS');
		$timeString .=" of " . date('F');
		$timeString .=" " . date('Y');
		$timeString .=", The time is " . date('h:i:s');
				

		return '<p>' . $timeString .  '</p>';
	}
}


// Friday, the 14th of September 2018, The time is '