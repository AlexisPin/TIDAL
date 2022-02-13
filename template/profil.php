<?php
require_once "dataUserController.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if($email != false && $password != false){
    $res = "SELECT * FROM users WHERE email = :email";
    $dbh->beginTransaction();
    $result = $dbh->prepare($res);
    $result->execute(array(':email' => "$email"));
    $queryResult = $result->fetch();
    $dbh->commit();
}
if(isset($queryResult))
{
    ?>
    <h1 id="welcome-message">Bienvenue <?php echo $queryResult['username'] ?></h1>
<?php
}else{
    ?>
    <h1 id="welcome-message">Vous n'êtes pas connecté</h1>
<?php
}
?>