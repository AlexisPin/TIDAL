<?php
require_once "dataUserController.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if ($flag_connexion) {
?>
    <div class="profil">
        <h1 id="welcome-message">Bienvenue <?php echo $_COOKIE['Username'] ?> </h1>

    </div>

<?php
} else {
?>
    <div class="profil">
        <h1 id="welcome-message">Vous n'êtes pas connecté</h1>

    </div>
<?php
}

?>