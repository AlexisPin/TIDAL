<?php

require_once 'config.php';

  $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";

  try{
     $conn = new PDO($dsn);
     
     if($conn){
      echo "<script>console.log(\"Connecté à $db avec succès!\")</script>";
     }
  }catch (PDOException $e){
     echo $e->getMessage();
  }
?>