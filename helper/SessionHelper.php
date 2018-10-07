<?php

function createUserSessions($user) {
    $_SESSION['user_name'] = $user->name;
}
