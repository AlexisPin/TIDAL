<?php 

$errors = array();
$succes = array();

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
        $insert_data = "SET IDENTITY_INSERT public.users ON; INSERT INTO public.users(username, email, password) VALUES(:username, :email, :password)";
        $dbh->beginTransaction();
        $result = $dbh->prepare($insert_data);
        $result->execute(array(":username" => $username,":email" => $email,":password" => $encpass));
        $queryResult = $result->fetch();
        $dbh->commit();
        if($queryResult){
            $succes['succes-register'] = "Votre compte a été crée avec succès, vous pouvez vous connecter dès à présent ";
        }else {
            $errors['db-error'] = "Erreur lors de l'insertion des données !";
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
        $result->execute(array(':email' => "$email"));
        
        if($result->rowCount()  > 0){
            $queryResult = $result->fetch();
            $dbh->commit();
            $fecth_pass = $queryResult['password'];
            if(password_verify($password, $fetch_pass)){
                // retenir l'email et le nom de la personne connectée pendant 5 minutes
                setcookie(
                    'Username',
                    $queryResult['username'],
                    [
                        'expires' => time() + 5*60,
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
                setcookie(
                    'Email',
                    $queryResult['email'],
                    [
                        'expires' => time() + 5*60,
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
            
                    header('location: ?filter');
            }else{
                $errors['email'] = "Mot de passe ou email incorrect !";
            }
        }else{
            $errors['email'] = "Vous n'êtes pas encore inscrit, inscrivez-vous en cliquant sur le bouton en bas.";
        }
    }
?>