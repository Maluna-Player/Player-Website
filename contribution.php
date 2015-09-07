<?php

session_start();

function formatContributionContent($content)
{
    $content = nl2br(htmlspecialchars($content));

    // Lien sur les adresses mail
    $content = preg_replace('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#', '<a href="mailto:$0">$0</a>', $content);

    // Lien sur les urls
    $content = preg_replace('#https?://[a-z0-9._/\?=&;-]+#i', '<a href="$0" target="_blank">$0</a>', $content);

    return $content;
}

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
                                /** Obtention du nombre de contributions **/

                                $request = $pdo->query('SELECT COUNT(*) AS contribution_nb FROM contribution');
                                $data = $request->fetch();
                                $contributionNb = $data['contribution_nb'];
                                $request->closeCursor();

                                if ($contributionNb == 0)
                                {
                                    echo '<p>Aucune contribution</p>';
                                }
                                else
                                {
                                    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                    $request = $pdo->query('SELECT title, content, author,
                                                            DATE_FORMAT(sendingDate, \'%d/%m/%Y\') AS date,
                                                            DATE_FORMAT(sendingDate, \'%H:%i:%s\') AS time
                                                            FROM contribution ORDER BY sendingDate DESC
                                                            LIMIT ' . ($page - 1) * 10 . ', 10');

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
                                            <p class="contributionContent"><?php echo formatContributionContent($data['content']); ?></p>
                                        </div>
                                    <?php
                                    }

                                    $request->closeCursor();

                                    /** Affichage des liens vers les autres pages **/

                                    if ($contributionNb % 10 == 0)
                                        $pageNb = $contributionNb / 10;
                                    else
                                        $pageNb = $contributionNb / 10 + 1;

                                    echo '<p>';
                                    for ($i = 1; $i <= $pageNb; $i++)
                                    {
                                        if ($i == $page)
                                            echo '<span>' . $i . '</span> ';
                                        else
                                            echo '<span><a href="contribution.php?page=' . $i . '" class="pageLink">' . $i . '</a></span> ';
                                    }
                                    echo '</p>';
                                }
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
