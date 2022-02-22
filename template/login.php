<?php
require_once "src/controller/dataUserController.php";
?>

<form id="connection-form" action="?login" method="POST">
    <?php
    if (count($errors) >= 1) {
        foreach ($errors as $showerror) {
    ?>
            <div class="error-container">
                <?php echo $showerror;
                ?>
            </div>
    <?php
        }
    }
    ?>
    <div class="email-container">
        <label for="email">Email</label>
        <input type="email" autocomplete="off" name="email" id="email" required value="<?php echo $email ?>">
    </div>

    <div class="password-container">
        <label for="password">Mot de passe</label>
        <input type="password" autocomplete="off" name="password" id="password" required>
    </div>
    <input type="submit" name="login" value="Se connecter">
    <div class="signup-container">Vous n'avez pas encore de compte ? <a href="?signup">S'inscrire</a></div>
</form>