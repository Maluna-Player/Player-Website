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

                    if (!isset($_POST['login']) || !isset($_POST['password']))
                    {
                        echo 'Le login ou le mot de passe n\'a pas été renseigné !';
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

                        $request = $pdo->prepare('SELECT password FROM member WHERE login = ?');
                        $request->execute(array($_POST['login']));

                        if (!($row = $request->fetch()))
                        {
                            echo 'Le compte <em>' . $_POST['login'] . '</em> n\'existe pas !';
                        }
                        else
                        {
                            if ($row['password'] != md5($_POST['password']))
                            {
                                echo 'Mot de passe incorrect !';
                            }
                            else
                            {
                                echo 'Vous êtes connectés en tant que <em>' . htmlspecialchars($_POST['login']) . '</em>';
                                $registered = true;

                                $_SESSION['user'] = $_POST['login'];
                            }
                        }

                        $request->closeCursor();
                    }

                    if (!$registered)
                        echo '<br/><br/><a href="connection.php">Revenir au formulaire</a>';
                    else
                        echo '<br/><br/><a href="index.php">Revenir à l\'accueil</a>';
                ?>
            </p>
        </div>

        <?php include("blocs/footer.php"); ?>
    </body>
</html>
