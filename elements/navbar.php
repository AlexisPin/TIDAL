<nav>
    <?php
    $flag_connexion = false;
    if (isset($_COOKIE["Username"])) {
        $sql = "SELECT * FROM public.users t1 WHERE t1.username = :username AND t1.useruniqueid = :useruniqueid;";
        $dbh->beginTransaction();
        $users = $dbh->prepare($sql);
        $users->execute(array(':username' => $_COOKIE["Username"], ':useruniqueid' => $_COOKIE["UserUniqueID"]));
        $users_data = $users->fetch();
        $dbh->commit();
    }
    if ($users_data) {
        $flag_connexion = true;
    }
    ?>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">TIDAL</label>
    <ul>
        <li><a href="?filter" class=<?php if ($uri == '/?filter' || $uri == '/') {
                                        echo "active";
                                    } ?>> Accueil</a></li>
        <?php if ($flag_connexion == false) :  ?>
            <li><a href="?login" class=<?php if ($uri == '/?login') {
                                            echo "active";
                                        } ?>>Connexion</a></li>
        <?php else :  ?>
            <li><a href="?logout" class=<?php if ($uri == '/?logout') {
                                            echo "active";
                                        } ?>>Deconnexion</a></li>
            <li><a href="?profil" class=<?php if ($uri == '/?profil') {
                                            echo "active";
                                        } ?>>Profil</a></li>
            <li><a href="?search" class=<?php if ($uri == '/?search') {
                                            echo "active";
                                        } ?>>Recherche avancée</a></li>
        <?php endif; ?>
        <li><a href="?bibliographie" class=<?php if ($uri == '/?bibliographie') {
                                                echo "active";
                                            } ?>>Bibliographie</a></li>
    </ul>
</nav>