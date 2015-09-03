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
                    session_destroy();
                ?>

                Vous êtes déconnecté.
                <br/><br/><a href="index.php">Revenir à l'accueil</a>
            </p>
        </div>

        <?php include("blocs/footer.php"); ?>
    </body>
</html>
