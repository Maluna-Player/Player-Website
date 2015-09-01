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
            <section class="contribution">
                <h2 class="small">Signaler un bug ou apporter une suggestion</h2>

                <form method="post" action="traitement.php">
                    <table>
                        <tr>
                            <td><label for="issueTitle">Titre :</label></td>
                            <td><input type="text" name="issueTitle" id="issueTitle" size="60" maxlength="50" autofocus required /></td>
                        </tr>
                        <tr>
                            <td><label for="issueContent">Description :</label></td>
                            <td><textarea name="issueContent" id="issueContent" rows="10" cols="50" required></textarea></td>
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
