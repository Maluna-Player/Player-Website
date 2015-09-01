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
        <?php include("header.php"); ?>

        <div id="mainBloc">
            <section class="download">
                <h2 class="small">Liens de téléchargement prochainement disponibles</h2>

                <h3>Compiler les sources</h3>
                <p>Rendez-vous sur le Git du projet <a href="https://github.com/Maluna34/Player" target="_blank">ici</a></p>
            </section>
        </div>

        <?php include("footer.php"); ?>
    </body>
</html>
