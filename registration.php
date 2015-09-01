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
            <section class="registration">
                <h2 class="small">Inscription</h2>

                <form method="post" action="memberRegistration.php">
                    <table>
                        <tr>
                            <td><label for="login">Pseudo :</label></td>
                            <td><input type="text" name="login" id="login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>" maxlength="50" autofocus required /></td>
                        </tr>
                        <tr>
                            <td><label for="password">Mot de passe :</label></td>
                            <td><input type="password" name="password" id="password" required /></td>
                        </tr>
                        <tr>
                            <td><label for="secondPassword">Confirmation :</label></td>
                            <td><input type="password" name="secondPassword" id="secondPassword" required /></td>
                        </tr>
                        <tr>
                            <td><label for="mail">Mail :</label></td>
                            <td><input type="email" name="mail" id="mail" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];} ?>" required /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Envoyer" /></td>
                        </tr>
                    </table>
                </form>
            </section>
        </div>

        <?php include("footer.php"); ?>
    </body>
</html>
