<?php


require 'connect.php';

$sql = "SELECT * FROM public.users;";
$dbh->beginTransaction();
$users = $dbh->prepare($sql);
$users->execute();

// Validation du formulaire
if (isset($_POST["Username"]) && isset($_POST['email']) &&  isset($_POST['password'])) {
    $Username = $_POST["Username"];
    $Email = $_POST["email"];
    $Pass_word = $_POST["password"];

    $sql = "$sql = 'SELECT * FROM public.users";
    $dbh->beginTransaction();
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array('Username' => $Username , 'Email' => $Email , 'pass_word' => $Pass_word));
        $data = $sth->fetchAll();
        $dbh->commit();
    } 
    catch(PDOException $e) {
        echo "SUPER";
        $dbh->rollback();
    }
}
?>
<h1>Sign up</h1>
<form action="signup.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="Username" class="form-label">Username</label>
        <input type="text" class="form-control" id="Username" name="Username">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help"
            placeholder="you@exemple.com">
        <div id="email-help" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Send</button>