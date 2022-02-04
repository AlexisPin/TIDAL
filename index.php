<?php

   require 'template/connect.php';

   $sql = "SELECT * FROM public.patho;";
   $pathos = $conn->prepare($sql);
   $pathos->execute();

   while ($row = $pathos->fetch(PDO::FETCH_ASSOC)) {
      echo $row['desc'];
      var_dump($row);
      echo " ";
   }
   $conn=null;
   

   require 'elements/header.php';

   define('MAIN_PATH', getcwd());
   require(MAIN_PATH . '/inc/smarty-4.0.4/libs/Smarty.class.php');
   $Smarty = new Smarty();
   $Smarty->setTemplateDir(MAIN_PATH . '/template');

   echo $_SERVER['REQUEST_URI'];

   $uri = $_SERVER['REQUEST_URI'];
   require 'elements/navbar.php';
   if ($uri == '/filter') {
   require 'template/filter.php';
   } elseif ($uri == '/connexion') {
   require 'template/home.php';
   } elseif ($uri == '/search') {
      require 'template/search.php';
      }

   require 'elements/footer.php';
