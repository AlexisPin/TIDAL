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

   //Si utilisateur/trice est non identifié(e), on affiche le formulaire

if(!isset($_COOKIE["Username"])): ?>
<form action="home.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
    <?php endif; ?>
    <div class="form-container">
        <div class="connexion-form">
            <label for="email" class="form-label">Email : </label>
            <input type="email" class="email-input" id="email" name="email" placeholder="you@exemple.com">
            <label for="password" class="form-label">Mot de passe : </label>
            <input type="password" class="password-input" id="password" name="password" placeholder="mot de passe">
            <button type="submit" class="submit-btn">Valider</button>
            <p>Vous n'avez pas encore de compte inscrivez-vous : </p>
            <div class="signup-link"><a href="?signup">S'inscrire</a></div>
        </div>
    </div>
</form>

<!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès
-->
<?php else: ?>
<meta http-equiv="refresh" content="1; url=../index.php" />
<?php endif; ?>