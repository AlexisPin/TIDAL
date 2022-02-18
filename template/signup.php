<?php
require_once "dataUserController.php";
?>

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
        <input type="text" autocomplete="on" name="username" id="username" required value="<?php echo $username ?>">
    </div>

    <div class="email-container">
        <label for="email">Email</label>
        <input type="email" autocomplete="on" name="email" id="email" required value="<?php echo $email ?>">
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