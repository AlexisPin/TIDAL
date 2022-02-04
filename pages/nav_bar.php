<?php ob_start(); ?>

<nav>
    <label class="logo">TIDAL</label>
    <ul>
      <li><a class="active" href="index.html">Acceuil</a></li>
      <li><a href="#">Recherche avancée</a></li>
      <li><a href="src/home.php">Connexion</a></li>
      <li><a href="src/bibliographie.html">Bibliographie</a></li>
    </ul>
</nav>

<?php $nav_bar = ob_get_clean(); ?>
