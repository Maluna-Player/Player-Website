<?php

include_once('class/User.class.php');
include_once('checkFormFields.php');

if (!isset($_SESSION['id']))
{
    header('Location: index.php');
}
elseif (checkFormFields(array('oldPassword', 'newPassword', 'secondNewPassword')))
{
    $user = new User($_SESSION['id']);

    if ($user->getPassword() != sha1($_POST['oldPassword']))
    {
        $message = 'Le mot de passe initial du compte est invalide !';
    }
    elseif ($_POST['newPassword'] != $_POST['secondNewPassword'])
    {
        $message = 'Les mots de passes indiqués sont différents';
    }
    else
    {
        $user->setPassword(sha1($_POST['newPassword']));
        header('Location: index.php?page=profile/profile');
    }

    include('views/profile/passwordModificationResult_V.php');
}
elseif (checkFormFields(array('newMail')))
{
    $user = new User($_SESSION['id']);
    $user->setMail($_POST['newMail']);

    header('Location: index.php?page=profile/profile');
}
elseif (isset($_GET['attr']))
{
    switch ($_GET['attr'])
    {
        case 'mdp':
            include('views/profile/passwordModification_V.php');
            break;

        case 'mail':
            include('views/profile/mailModification_V.php');
            break;
    }
}
else
{
    header('Location: index.php?page=profile/profile');
}
