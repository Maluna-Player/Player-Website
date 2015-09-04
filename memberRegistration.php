<?php
    session_start();
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
                        else
                        {
                            try
                            {
                                $pdo = new PDO('mysql:host=localhost;dbname=player_db;charset=utf8', 'root', '',
                                                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                            }
                            catch (Exception $e)
                            {
                                die('Erreur : ' . $e->getMessage());
                            }

                            $request = $pdo->prepare('SELECT login FROM member WHERE login = ?');
                            $request->execute(array($_POST['login']));

                            if ($request->fetch())
                            {
                                echo 'Le pseudo choisi n\'est pas disponible.';
                            }
                            else
                            {
                                $request->closeCursor();

                                $request = $pdo->prepare('INSERT INTO member(login, password, mail, admin) VALUES(:login, :password, :mail, 0)');
                                $request->execute(array(':login' => $_POST['login'],
                                                        ':password' => md5($_POST['password']),
                                                        ':mail' => $_POST['mail']));

                                echo 'Inscription réalisée avec succès !';
                                $registered = true;

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
