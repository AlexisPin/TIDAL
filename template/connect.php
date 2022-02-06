<?php

require_once 'config.php';

  $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$utilisateur;password=$mdp";

  try{
     $dbh = new PDO($dsn);
     
     if($dbh){
      echo "<script>console.log(\"Connecté à $db avec succès!\")</script>";
     }
  }catch (PDOException $e){
     echo $e->getMessage();
     echo "<script>console.log(\"Impossible de se connecter à $db!\")</script>";
  }
?>