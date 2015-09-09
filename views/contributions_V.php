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
            <section class="contributionForm">
                <h2 class="small">Signaler un bug ou apporter une suggestion</h2>

                <form method="post" action="index.php?page=contributionReceive">
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

            if ($user->isAdmin())
            {
            ?>
                </section class="contributionsList">
                    <h2 class="small">Liste des contributions</h2>

                    <?php
                        if ($contributionNb == 0)
                        {
                            echo '<p>Aucune contribution</p>';
                        }
                        else
                        {
                            foreach ($contributions as $contribution)
                            {
                            ?>
                                <div class="contribution">
                                    <div class="contributionHeader">
                                        <p class="contributionLeftPart">
                                            <span class="contributionTitle"><?php echo $contribution['title']; ?></span>
                                            <span class="contributionSignature">by <span class="contributionAuthor"><?php echo $contribution['author']; ?></span><span>
                                        </p>
                                        <p class="contributionDatetime">
                                            <span class="contributionDate"><?php echo $contribution['date']; ?></span>
                                            <span class="contributionTime"><?php echo $contribution['time']; ?></span>
                                        </p>
                                    </div>
                                    <p class="contributionContent"><?php echo $contribution['content']; ?></p>
                                </div>
                            <?php
                            }
                            ?>
                            
                            <p>
                                <?php

                                for ($i = 1; $i <= $pageNb; $i++)
                                {
                                    if ($i == $page)
                                        echo '<span>' . $i . '</span> ';
                                    else
                                        echo '<span><a href="index.php?page=contributions&pageNum=' . $i . '" class="pageLink">' . $i . '</a></span> ';
                                }

                                ?>
                            </p>
                        <?php
                        }
                    ?>
                </section>
            <?php
            }
            ?>
        </div>

        <?php include("views/footer.php"); ?>
    </body>
</html>
