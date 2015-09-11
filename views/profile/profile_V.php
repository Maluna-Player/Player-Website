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
                <h2 class="small">Profil</h2>

                <p>
                    <table>
                        <tr>
                            <th>Pseudo :</th>
                            <td><?php echo $login; ?></td>
                        </tr>
                        <tr>
                            <th>Mot de passe :</th>
                            <td>*********</td>
                            <td><a href="index.php?page=profile/profileModification&attr=mdp">Modifier le mot de passe</a></td>
                        </tr>
                        <tr>
                            <th>Mail :</th>
                            <td><?php echo $mail; ?></td>
                            <td><a href="index.php?page=profile/profileModification&attr=mail">Modifier l'adresse mail</a></td>
                        </tr>
                    </table>
                </p>
            </section>
        </div>

        <?php include("views/footer.php"); ?>
    </body>
</html>
