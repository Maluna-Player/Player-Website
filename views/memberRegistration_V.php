<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Player</title>
    </head>
    <body>
        <?php include("controllers/header_C.php"); ?>

        <div id="mainBloc">
            <p>
                <?php
                    echo $message;
                    echo '<br/><br/>';

                    if ($registered)
                    {
                    ?>
                        <a href="index.php">Revenir à l'accueil</a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a href="index.php?page=registration">Revenir au formulaire</a>
                    <?php
                    }
                ?>
            </p>
        </div>

        <?php include("views/footer.php"); ?>
    </body>
</html>
