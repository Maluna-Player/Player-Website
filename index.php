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
            <section class="description">
                <h2>
                    <span class="pink large">Le premier</span><br/>
                    <span class="green small rotate">player</span>
                    <span class="orange medium"> connecte</span>
                </h2>
                <h3 class="small">Partage de la musique avec tes amis</h3>

                <audio controls preload="none">
                    <source src="Kalimba.mp3">
                    Extrait musical ne pouvant être affiché sur ce navigateur
                </audio>
            </section>

            <div class="textBloc">
                <h4>Lecture de musiques</h4>
                <p>Le player permet aussi de lire automatiquement tes musiques préférées regroupées dans un même dossier.</p>
            </div>
            <div class="textBloc">
                <h4>Connexion avec un ami</h4>
                <p>Récupérez le code de votre ami et connectez-vous avec lui. Récupérez sa liste de musique et partagez vos écoutes.</p>
            </div>
            <div class="textBloc">
                <h4>Partage de musiques</h4>
                <p>Il vous est possible de lire les musiques de votre ami, partagez vos morceux préférés.</p>
            </div>

            <section class="accueil">
                <h2>
                    <span class="orange medium">Accu</span><span class="pink medium">eil</span>
                </h2>

                <ul>
                    <li>
                        <figure>
                            <a href="downloads.php"><span></span><img src="images/download.png" alt="image" /></a>
                            <figcaption>Téléchargements</figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <a href="contribution.php"><span></span><img src="images/contribution.png" alt="image" /></a>
                            <figcaption>Contribution</figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <a href="https://github.com/Maluna34/Player" target="_blank"><span></span><img src="images/git.png" alt="image" /></a>
                            <figcaption>Dépôt Git</figcaption>
                        </figure>
                    </li>
                </ul>
            </section>
        </div>

        <?php include("footer.php"); ?>
    </body>
</html>
