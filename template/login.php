<?php

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

<<<<<<< HEAD
   //Si utilisateur/trice est non identifié(e), on affiche le formulaire

if(!isset($_COOKIE["Username"])): ?>
=======
<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<?php if(!isset($_COOKIE["Username"])): ?>
    <div class="form_connexion">
>>>>>>> 2dd181b2f01306475b58f70046b062ef813caad2
<form action="home.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>
<!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès
-->
<?php else: ?>
    <meta http-equiv="refresh" content="1; url=../index.php" />
<?php endif; ?>

<div>
<a href="./signup.php">S'inscrire</a> 
</div>