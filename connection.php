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
            <?php include("blocs/connectionForm.php"); ?>
        </div>

        <?php include("blocs/footer.php"); ?>
    </body>
</html>
