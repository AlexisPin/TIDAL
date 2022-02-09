<?php

    $sql = "CREATE TABLE public.users(
      username VARCHAR(50) NOT NULL,
      email VARCHAR(50) NOT NULL,
      password VARCHAR(100) NOT NULL,
      UNIQUE(email))";
      $dbh->exec($sql);

      echo "<script>console.log(\"Table bien crée ! \")</script>";

?>