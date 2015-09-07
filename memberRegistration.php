<?php

session_start();

include_once('class/DbConnection.class.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Player</title>
    </head>
    <body>
        <?php include("blocs/header.php"); ?>

        <div id="mainBloc">
            <p>
                <?php
                    $registered = false;

                    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['secondPassword']) && isset($_POST['mail']))
                    {
                        if ($_POST['password'] != $_POST['secondPassword'])
                        {
                            echo 'Les mots de passe sont différents !';
                        }
                        elseif (strlen($_POST['password']) < 6)
                        {
                            echo 'Le mot de passe est trop court !';
                        }
                        elseif (!preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#', $_POST['mail']))
                        {
                            echo 'L\'adresse mail saisie est invalide !';
                        }
                        else
                        {
                            $pdo = DbConnection::getPDO();

                            $request = $pdo->prepare('SELECT login FROM member WHERE login = ?');
                            $request->execute(array($_POST['login']));

                            if ($request->fetch())
                            {
                                echo 'Le pseudo choisi n\'est pas disponible.';
                            }
                            else
                            {
                                $request->closeCursor();

                                $request = $pdo->prepare('INSERT INTO member(login, password, mail, registrationDate, admin)
                                                          VALUES(:login, :password, :mail, NOW(), 0)');
                                $request->execute(array(':login' => $_POST['login'],
                                                        ':password' => sha1($_POST['password']),
                                                        ':mail' => $_POST['mail']));

                                $memberId = $pdo->lastInsertId();

                                echo 'Inscription réalisée avec succès !';
                                $registered = true;

                                $_SESSION['id'] = $memberId;
                                $_SESSION['user'] = $_POST['login'];
                            }
                        }
                    }
                    else
                    {
                        echo 'Tous les champs ne sont pas remplis correctement !';
                    }

                    if (!$registered)
                        echo '<br/><br/><a href="registration.php">Revenir au formulaire</a>';
                    else
                        echo '<br/><br/><a href="index.php">Revenir à l\'accueil</a>';
                ?>
            </p>
        </div>

        <?php include("blocs/footer.php"); ?>
    </body>
</html>
