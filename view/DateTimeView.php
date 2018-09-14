<?php
namespace view;

class DateTimeView {

    public function show() {

        $timeString = date('l');
        $timeString .= ", the " . date('jS');
        $timeString .= " of " . date('F');
        $timeString .= " " . date('Y');
        $timeString .= ", The time is " . date('h:i:s');

        return '<p>' . $timeString . '</p>';
    }
}
