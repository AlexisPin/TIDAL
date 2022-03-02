<?php
$sql = "CREATE TABLE public.users(
      userID smallint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 ) PRIMARY KEY,
      username VARCHAR(50) NOT NULL,
      email VARCHAR(50) NOT NULL,
      userUniqueID VARCHAR(100),
      password VARCHAR(100) NOT NULL,
      UNIQUE(email),
      UNIQUE(userUniqueID))";

$this->conn->exec($sql);

function generateRandomString($length = 25)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
