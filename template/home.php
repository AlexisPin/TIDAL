<div class="container">

    <!-- Inclusion du formulaire de connexion -->
    <?php require 'login.php'; ?>

    <!-- Si l'utilisateur existe, on route sur acceuil  -->
    <?php if(isset($loggedUser)): ?>
    <?php require 'filter.php'; ?>
    <?php endif; ?>
</div>