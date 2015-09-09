<?php

include_once('class/User.class.php');

$registered = false;

if (!isset($_POST['login']) || !isset($_POST['password']))
{
    $message = 'Le login ou le mot de passe n\'a pas été renseigné !';
}
else
{
    $userRow = User::getUserRowFromLogin($_POST['login']);

    if (!$userRow)
    {
        $message = 'Le compte <em>' . $_POST['login'] . '</em> n\'existe pas !';
    }
    else
    {
        if ($userRow['password'] != sha1($_POST['password']))
        {
            $message = 'Mot de passe incorrect !';
        }
        else
        {
            $message = 'Vous êtes connectés en tant que <em>' . htmlspecialchars($_POST['login']) . '</em>';
            $registered = true;

            $_SESSION['id'] = $userRow['idMember'];
            $_SESSION['user'] = $userRow['login'];
        }
    }
}

include('views/memberConnection_V.php');
