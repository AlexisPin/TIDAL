<?php
 require_once "dataUserController.php";


// $users = [
//     [
//     'Name' => 'Tidal tidal',
//     'email' => 'tidal@tidal.tidal',
//     'password' =>  'tidal',
//     ],
// ];

// Validation du formulaire
// if (isset($_POST['email']) &&  isset($_POST['password'])) {
//     foreach ($users as $user) {
//         if (
//             $user['email'] === $_POST['email'] &&
//             $user['password'] === $_POST['password']
//         ) {
//             // retenir l'email et le nom de la personne connectée pendant 5 minutes
//             setcookie(
//                 'Username',
//                 $user['Name'],
//                 [userID smallint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 ) PRIMARY KEY,re' => true,
//                     'httponly' => true,
//                 ]
//                 );
//         } else {
//             $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
//                 $_POST['email'],
//                 $_POST['passwordset'],
//             );
//         }
//     }
// }

   //Si utilisateur/trice est non identifié(e), on affiche le formulaire
?>
<form id="connection-form" action="?login" method="POST">
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
