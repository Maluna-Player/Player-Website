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
                <h2 class="small">Modification du mot de passe</h2>

                <form method="post" action="index.php?page=profile/profileModification">
                    <table>
                        <tr>
                            <td><label for="oldPassword">Ancien mot de passe :</label></td>
                            <td><input type="password" name="oldPassword" id="oldPassword" autofocus required /></td>
                        </tr>
                        <tr>
                            <td><label for="newPassword">Nouveau mot de passe :</label></td>
                            <td><input type="password" name="newPassword" id="newPassword" required /></td>
                        </tr>
                        <tr>
                            <td><label for="secondNewPassword">Confirmez le mot de passe :</label></td>
                            <td><input type="password" name="secondNewPassword" id="secondNewPassword" required /></td>
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
