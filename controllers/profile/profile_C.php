<?php

include_once('class/User.class.php');

if (isset($_SESSION['id']))
{
    $user = new User($_SESSION['id']);

    $login = $user->getLogin();
    $mail = $user->getMail();

    include('views/profile/profile_V.php');
}
