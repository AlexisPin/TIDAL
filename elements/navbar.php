<nav>
    <?php

    $flag_connexion = false;

    $sql = "SELECT * FROM public.users;";
    $dbh->beginTransaction();
    $users = $dbh->prepare($sql);
    $users->execute();
    $users_data = $users->fetchAll();
    $dbh->commit();
     
    if (isset($_COOKIE["Username"])) :
        foreach ($users_data as $user) {
            if ($_COOKIE["Username"] == $user["username"]) :
                if ($_COOKIE["UserUniqueID"] == $user["useruniqueid"]) :
                    $flag_connexion = true;        
                endif;
            endif;
        }
    endif;
    
    console_log($flag_connexion);
    ?>

    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">TIDAL</label>
    <ul>
        <li><a href="?filter">Acceuil</a></li> 
        <?php if($flag_connexion == false):  ?>
        <li><a href="?login">Connexion</a></li>
        <?php else :  ?>
                <li><a href="?login">Deconnexion</a></li>  
                <li><a href="?login">Profil</a></li>  
                <li><a href="?search">Recherche avancée</a></li>
        <?php endif;?>
        <li><a href="?bibliographie">Bibliographie</a></li>
    </ul>
</nav>