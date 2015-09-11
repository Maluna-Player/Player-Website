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
            <section class="profile">
                <h2 class="small">Modification de l'adresse mail</h2>

                <form method="post" action="index.php?page=profile/profileModification">
                    <table>
                        <tr>
                            <td><label for="newMail">Nouveau mail :</label></td>
                            <td><input type="text" name="newMail" id="newMail" autofocus required /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Modifier" /></td>
                        </tr>
                    </table>
                </form>
            </section>
        </div>

        <?php include("views/footer.php"); ?>
    </body>
</html>
