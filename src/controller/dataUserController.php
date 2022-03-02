<?php
include_once 'models/User.php';

session_start();
$email = "";
$username = "";
$errors = array();
$succes = array();

$user = new User($dbh);

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];

    $queryResult = true;
    while ($queryResult) {
        $userUniqueID = generateRandomString();
        $user->useruniqueid = $userUniqueID;
        $queryResult = $user->uniqueId_is_exist();
    }

    if ($password !== $confpassword) {
        $errors['password'] = "Les mots de passe de correspondent pas !";
    }
    $queryResult = $user->email_is_exist();
    if ($queryResult) {
        $errors['email'] = "L'email que vous avez entré existe déjà !";
    }
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $user->username = $username;
        $user->email = $email;
        $user->password = $encpass;
        $user->useruniqueid = $userUniqueID;
        $queryResult = $user->createUser();

        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        if ($queryResult) {
            $succes['succes-register'] = "Votre compte a été crée avec succès, vous pouvez vous connecter dès à présent ";
            $succes['redirection'] = "Vous allez être redirigé vers la page de connexion ";
?>
            <meta http-equiv="refresh" content="2; url=?login" />
<?php
        } else {
            $errors['db-error'] = "Erreur lors de l'insertion des données !";
        }
    }
}

if (isset($_POST['login'])) {
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $user->email = $email;
    $queryResult = $user->email_is_exist();

    if ($queryResult) {
        $fetch_pass = $queryResult['password'];
        if (password_verify($password, $fetch_pass)) {
            $ID = $queryResult["useruniqueid"];

            setcookie(
                'UserUniqueID',
                $ID,
                [
                    'expires' => time() + 50 * 60,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
            setcookie(
                'Username',
                $queryResult['username'],
                [
                    'expires' => time() + 50 * 60,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
            setcookie(
                'Email',
                $queryResult['email'],
                [
                    'expires' => time() + 50 * 60,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
            header('location: ?filter');
        } else {
            $errors['email'] = "Mot de passe ou email incorrect !";
        }
    } else {
        $errors['email'] = "Vous n'êtes pas encore inscrit, inscrivez-vous en cliquant sur le bouton en bas.";
    }
}
?>