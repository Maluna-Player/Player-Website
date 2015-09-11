<?php

include_once('class/User.class.php');
include_once('checkFormFields.php');

$registered = false;

if (checkFormFields(array('login', 'password', 'secondPassword', 'mail')))
{
    if ($_POST['password'] != $_POST['secondPassword'])
    {
        $message = 'Les mots de passe sont différents !';
    }
    elseif (strlen($_POST['password']) < 6)
    {
        $message = 'Le mot de passe est trop court !';
    }
    elseif (!preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#', $_POST['mail']))
    {
        $message = 'L\'adresse mail saisie est invalide !';
    }
    else
    {
        if (User::getUserRowFromLogin($_POST['login']))
        {
            $message = 'Le pseudo choisi n\'est pas disponible.';
        }
        else
        {
            $memberId = User::addUser($_POST['login'], sha1($_POST['password']), $_POST['mail']);

            $message = 'Inscription réalisée avec succès !';
            $registered = true;

            $_SESSION['id'] = $memberId;
            $_SESSION['user'] = $_POST['login'];
        }
    }
}
else
{
    $message = 'Tous les champs ne sont pas remplis correctement !';
}

include('views/memberRegistration_V.php');
