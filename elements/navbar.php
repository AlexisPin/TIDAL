<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">TIDAL</label>
    <ul>
        <li><a href="?filter">Accueil</a></li>
       
        <?php if(!isset($_COOKIE["Username"]) && !isset($_SESSION["connect"])):  ?>
        <li><a href="?login">Connexion</a></li>
        <?php else :  
            console_log($_SESSION["connect"]);
            if ($_SESSION['connect'] == 'true') : ?>
                <li><a href="?login">Deconnexion</a></li>  
                <li><a href="?login">Profil</a></li>  
                <li><a href="?search">Recherche avancée</a></li>
            <?php else : ?>
                <li><a href = "">Ratio</a></li>
            <?php endif;?>
        <?php endif;?>
       
        <li><a href="?bibliographie">Bibliographie</a></li>
    </ul>
</nav>