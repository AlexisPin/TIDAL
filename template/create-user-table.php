<?php

    $sql = "CREATE TABLE public.users(
      userID smallint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 ) PRIMARY KEY,
      username VARCHAR(50) NOT NULL,
      email VARCHAR(50) NOT NULL,
      userUniqueID int,
      password VARCHAR(100) NOT NULL,
      UNIQUE(email),
      UNIQUE(userUniqueID))";

      $dbh->exec($sql);
      echo "<script>console.log(\"Table bien crée ! \")</script>";

?>