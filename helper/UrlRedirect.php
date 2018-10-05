<?php

function redirectToPage($page) {
    header('location: ' . URLROOT . '/' . $page);
}
