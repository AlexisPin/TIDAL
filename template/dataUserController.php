<?php 
session_start();
require "template/connect.php";
$email = "";
$username = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];
    if($password !== $confpassword){
        $errors['password'] = "Les mots de passe de correspondent pas !";
    }
    $email_check = "SELECT * FROM public.users WHERE email = :email";
    $dbh->beginTransaction();
    $result = $dbh->prepare($email_check);
    $result->execute(array(':email' => "$email"));
    $queryResult = $result->fetch();
    $dbh->commit();

    if($result->rowCount() > 0){
        $errors['email'] = "L'email que vous avez entré existe déjà !";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $insert_data = "INSERT INTO public.users (username, email, password )
                        values('$username', '$email', '$encpass')";
        $dbh->beginTransaction();
        $result = $dbh->prepare($insert_data);
        $result->execute();
        $queryResult = $result->fetchAll();
        $dbh->commit();
        if(!$queryResult){
            $errors['db-error'] = "Erreur lors de l'insertion des données!";
        }
    }
}
    //if user click login button
    if(isset($_POST['login'])){
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $check_email = "SELECT * FROM users WHERE email = :email";
        $dbh->beginTransaction();
        $result = $dbh->prepare($check_email);
        $result->execute(array(':email' => "$search"));

        if($result->rowCount()  > 0){
            $queryResult = $result->fetch();
            $dbh->commit();
            $fecth_pass = $queryResult['password'];
            if(password_verify($password, $fetch_pass)){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: ?filter');
            }else{
                $errors['email'] = "Mot de passe ou email incorrect !";
            }
        }else{
            $errors['email'] = "Vous n'êtes pas encore inscrit, inscrivez-vous en cliquant sur le bouton en bas.";
        }
    }
?>