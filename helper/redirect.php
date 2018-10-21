<?php

// Simple helper function for redirection of user.
function redirectToPageUrl($page) {
    header('location: ' . URLROOT . '/' . $page);
}
