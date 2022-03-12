<nav>
    <?php
    $flag_connexion = false;
    if (isset($_COOKIE["Username"])) {
        $sql = "SELECT * FROM public.users t1 WHERE t1.username = :username AND t1.useruniqueid = :useruniqueid;";
        $users = $dbh->prepare($sql);
        $users->execute(array(':username' => $_COOKIE["Username"], ':useruniqueid' => $_COOKIE["UserUniqueID"]));
        $users_data = $users->fetch();
        if ($users_data) {
            $flag_connexion = true;
        }
    }
    ?>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">TIDAL</label>
    <ul id='path'>
        <li><a href="/" class=<?php if ($uri == '/') {
                                    echo "active";
                                } ?>> Accueil</a></li>
        <?php if ($flag_connexion == false) :  ?>
            <li><a href="?login" class=<?php if ($uri == '/?login') {
                                            echo "active";
                                        } ?>>Connexion</a></li>
        <?php else :  ?>
            <li><a href="?profil" class=<?php if ($uri == '/?profil') {
                                            echo "active";
                                        } ?>>Profil</a></li>
            <li><a href="?search" class=<?php if ($uri == '/?search') {
                                            echo "active";
                                        } ?>>Recherche avancée</a></li>
            <li><a href="?logout" class=<?php if ($uri == '/?logout') {
                                            echo "active";
                                        } ?>>Deconnexion</a></li>
        <?php endif; ?>
        <li><a href="?bibliographie" class=<?php if ($uri == '/?bibliographie') {
                                                echo "active";
                                            } ?>>Bibliographie</a></li>
    </ul>
</nav>

<script type="text/javascript">
    const link = document.querySelector('#path');
    var isConnect = "<?php echo json_encode($flag_connexion); ?>";
    var isTrueSet = (isConnect === 'true');
    if (isTrueSet) {
        link.classList.add('connected');
    } else {
        link.classList.remove('connected');
    }
</script>