<?php

   require 'template/connect.php';

   // while ($row = $pathos->fetch(PDO::FETCH_ASSOC)) {
   //    echo $row['desc'];
   //   echo " ";
   // }
  

   require_once 'elements/header.php';

   define('MAIN_PATH', getcwd());
   require(MAIN_PATH . '/inc/smarty-4.0.4/libs/Smarty.class.php');
   $Smarty = new Smarty();
   $Smarty->setTemplateDir(MAIN_PATH . '/template');

   $uri = $_SERVER['REQUEST_URI'];
   require 'elements/navbar.php';
   
   switch($uri) {
      case '/?filter':
         require 'template/filter.php';
         break;
      case '/?connexion':
         require 'template/home.php';
         break;
      case '/?search':
         require 'template/search.php';
         break;
      case '/?search':
         require 'template/search.php';
         break;
      case '/?signup':
         require 'template/signup.php';
         break;
      case '/?check-form':
         require 'template/check-form.php';
         break;  
   }

   require_once 'elements/footer.php';
  $dbh=null;
   ?>
