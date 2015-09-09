<header>
    <div id="headerContainer">
        <div id="mainTitle">
            <a href="index.php"><img src="images/icon.ico" alt="Logo du Player" id="logo" /></a>
            <h1 id="title">
                <span class="orange">Net</span><span class="pink">work</span>
                <br/>
                <span class="purple">Pl</span><span class="blue">ay</span><span class="green">er</span>
            </h1>
        </div>

        <div id="links">
            <span id="signedBox">
                <span id="signed">Connecté : </span>
                <span id="userName"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
            </span>
            <a href="index.php?page=disconnection" id="disconnectionLink">Déconnexion</a>

            <nav>
                <ul>
                    <li><a href="index.php" class="greenHover">Accueil</a></li>
                    <li><a href="index.php?page=downloads" class="pinkHover">Téléchargements</a></li>
                    <li><a href="index.php?page=contributions" class="orangeHover">Contribution</a></li>
                    <li><a href="https://github.com/Maluna34/Player" target="_blank" class="purpleHover">Git</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="bottom"></div>
</header>
