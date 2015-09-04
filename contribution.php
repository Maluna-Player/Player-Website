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
            <?php
                if (!isset($_SESSION['user']))
                {
                    include("blocs/connectionForm.php");
                }
                else
                {
                ?>
                    <section class="contributionForm">
                        <h2 class="small">Signaler un bug ou apporter une suggestion</h2>

                        <form method="post" action="contributionReceive.php">
                            <table>
                                <tr>
                                    <td><label for="issueTitle">Titre :</label></td>
                                    <td><input type="text" name="issueTitle" id="issueTitle" size="66" autofocus required /></td>
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

                    <?php

                    try
                    {
                        $pdo = new PDO('mysql:host=localhost;dbname=player_db;charset=utf8', 'root', '',
                                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }
                    catch (Exception $e)
                    {
                        die('Erreur : ' . $e->getMessage());
                    }

                    $request = $pdo->prepare('SELECT admin FROM member WHERE login = ?');
                    $request->execute(array($_SESSION['user']));
                    $data = $request->fetch();

                    if ($data && $data['admin'])
                    {
                        $request->closeCursor();
                        ?>

                        </section class="contributionsList">
                            <h2 class="small">Liste des contributions</h2>

                            <?php
                                $request = $pdo->query('SELECT title, content, author,
                                                        DATE_FORMAT(sendingDate, \'%d/%m/%Y\') AS date,
                                                        DATE_FORMAT(sendingDate, \'%H:%i:%s\') AS time
                                                        FROM contribution ORDER BY sendingDate DESC LIMIT 0, 10');

                                while ($data = $request->fetch())
                                {
                                ?>
                                    <div class="contribution">
                                        <div class="contributionHeader">
                                            <p class="contributionLeftPart">
                                                <span class="contributionTitle"><?php echo htmlspecialchars($data['title']); ?></span>
                                                <span class="contributionSignature">by <span class="contributionAuthor"><?php echo htmlspecialchars($data['author']); ?></span><span>
                                            </p>
                                            <p class="contributionDatetime">
                                                <span class="contributionDate"><?php echo $data['date']; ?></span>
                                                <span class="contributionTime"><?php echo $data['time']; ?></span>
                                            </p>
                                        </div>
                                        <p class="contributionContent"><?php echo nl2br(htmlspecialchars($data['content'])); ?></p>
                                    </div>
                                <?php
                                }

                                $request->closeCursor();
                            ?>
                        </section>

                        <?php
                    }
                }
            ?>
        </div>

        <?php include("blocs/footer.php"); ?>
    </body>
</html>
