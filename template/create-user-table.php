<?php

    $sql = "CREATE TABLE public.users(
      userId SMALLINT identity(1,1) PRIMARY KEY,
      username VARCHAR(50) NOT NULL,
      email VARCHAR(50) NOT NULL,
      password VARCHAR(100) NOT NULL,
      UNIQUE(email))";

//$dbh->query("SET IDENTITY_INSERT public.users ON");
      $dbh->exec($sql);

      echo "<script>console.log(\"Table bien crée ! \")</script>";

?>