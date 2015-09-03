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
                    if (!isset($_POST['issueTitle']) || !isset($_POST['issueContent']))
                    {
                        echo 'Veillez à bien renseigner le titre et le contenu de votre contribution.';
                        echo '<br/><br/><a href="contribution.php">Revenir au formulaire</a>';
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

                        $request = $pdo->prepare('INSERT INTO contribution(title, content, author, sendingDate) VALUES(:title, :content, :author, NOW())');
                        $request->execute(array(':title' => $_POST['issueTitle'],
                                                ':content' => $_POST['issueContent'],
                                                ':author' => $_SESSION['user']));

                        echo 'Contribution envoyée.<br/>Merci pour votre participation !';
                        echo '<br/><br/><a href="index.php">Revenir à l\'accueil</a>';
                    }
                ?>
            </p>
        </div>

        <?php include("blocs/footer.php"); ?>
    </body>
</html>
