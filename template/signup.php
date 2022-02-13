<?php

require_once "dataUserController.php";

// $sql = "SELECT * FROM public.users;";
// $dbh->beginTransaction();
// $users = $dbh->prepare($sql);
// $users->execute();

// Validation du formulaire
// if (isset($_POST["username"]) && isset($_POST['email']) &&  isset($_POST['password'])) {
//     $Username = $_POST["Username"];
//     $Email = $_POST["email"];
//     $Pass_word = $_POST["password"];

//     $sql = "$sql = 'SELECT * FROM public.users";
//     $dbh->beginTransaction();
//     try {
//         $sth = $dbh->prepare($sql);
//         $sth->execute(array('Username' => $Username , 'Email' => $Email , 'pass_word' => $Pass_word));
//         $data = $sth->fetchAll();
//         $dbh->commit();
//     } 
//     catch(PDOException $e) {
//         echo "SUPER";
//         $dbh->rollback();
//     }
// }
// ?>

<h1>S'inscrire</h1>
<form id="connection-form" action="?signup" method="POST" autocomplete="on">
    <?php
    if(count($succes) >= 1){
    foreach($succes as $showsucces){
    ?>
    <div class="succes-container">
        <?php echo $showsucces; ?>
    <?php
    ?>
    </div>
    <?php 
    }
    } 
    ?>
    <?php
    if(count($errors) >= 1){
        foreach($errors as $showerror){
            ?>
        <div class="error-container">
            <?php echo $showerror;
            ?>
        </div>
        <?php
        }
    }
    ?>
    <div class="pseudo-container">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" autocomplete="on" name="username" id="username" required>
    </div>

    <div class="email-container">
        <label for="email">Email</label>
        <input type="email" autocomplete="on" name="email" id="email" required>
    </div>

    <div class="password-container">
        <label for="password">Mot de passe</label>
        <input type="password" autocomplete="on" name="password" id="password" required>
    </div>

    <div class="confirm-container">
        <label for="confpassword">Confirmer mot de passe</label>
        <input type="password" autocomplete="off" name="confpassword" id="confpassword" required>
    </div>

    <input type="submit" name="signup" value="S'inscrire">
    <div class="login-container">Déjà membre ? <a href="?login">Connectez-vous</a></div>
</form>