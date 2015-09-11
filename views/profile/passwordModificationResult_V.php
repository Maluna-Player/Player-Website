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
                <?php echo $message; ?>
                <br/><br/>
                <a href="index.php?page=profile/profileModification&attr=mdp">Revenir au formulaire</a>
            </p>
        </div>

        <?php include("views/footer.php"); ?>
    </body>
</html>
