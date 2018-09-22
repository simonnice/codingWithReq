<?php

// Create a connection
$conn = mysqli_connect('localhost', 'root', 'wiolethstaffan1', 'users');

// Check connection

if (mysqli_connect_errno()) {
    // Connection failed
    echo 'Failed to connect to DB' . mysqli_connect_errno();
}
