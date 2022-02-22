<?php
require_once "dataUserController.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if ($flag_connexion) {
?>
    <h1 id="welcome-message">Bienvenue <?php echo $_COOKIE['Username'] ?> </h1>
<?php
} else {
?>
    <h1 id="welcome-message">Vous n'êtes pas connecté</h1>
<?php
}
?>