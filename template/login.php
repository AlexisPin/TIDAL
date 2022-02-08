<?php
 require_once "dataUserController.php";
$users = [
    [
    'Name' => 'Tidal tidal',
    'email' => 'tidal@tidal.tidal',
    'password' =>  'tidal',
    ],
];



// Validation du formulaire
if (isset($_POST['email']) &&  isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            // retenir l'email et le nom de la personne connectée pendant 5 minutes
            setcookie(
                'Username',
                $user['Name'],
                [
                    'expires' => time() + 5*60,
                    'secure' => true,
                    'httponly' => true,
                ]
            );
            setcookie(
                'Email',
                $user['email'],
                [
                    'expires' => time() + 5*60,
                    'secure' => true,
                    'httponly' => true,
                ]
                );
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['email'],
                $_POST['passwordset'],
            );
        }
    }
}

   //Si utilisateur/trice est non identifié(e), on affiche le formulaire

if(!isset($_COOKIE["Username"])): ?>
<form id="connection-form" action="?login" method="POST">
    <?php
if(count($errors) == 1){
        ?>
    <div class="error-container">
        <?php
    foreach($errors as $showerror){
        echo $showerror;
    }
    ?>
    </div>
    <?php
        }elseif(count($errors) > 1){
            ?>
    <div class="error-container">
        <?php
    foreach($errors as $showerror){
        ?>
        <li><?php echo $showerror; ?></li>
        <?php
        }
        ?>
    </div>
    <?php
        }
        ?>
    <div class="email-container">
        <label for="email">Email</label>
        <input type="email" autocomplete="off" name="email" required value="<?php echo $email ?>">
    </div>

    <div class="password-container">
        <label for="password">Mot de passe</label>
        <input type="password" autocomplete="off" name="password" required>
    </div>
    <input type="submit" name="signup" value="Se connecter">
    <div class="signup-container">Vous n'avez pas encore de compte ? <a href="?signup">S'inscrire</a></div>
</form>

<!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès
-->
<?php else: ?>
<meta http-equiv="refresh" content="1; url=../index.php" />
<?php endif; ?>