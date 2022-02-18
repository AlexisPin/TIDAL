<?php

function console_log( $data ){
   echo '<script>';
   echo 'console.log('. json_encode( $data ) .')';
   echo '</script>';
 }
   require_once 'template/connect.php';

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
      case '/?login':
         require 'template/login.php';
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
      case '/?logout':
         require 'template/logout.php';
         break; 
      case '/?profil':
         require 'template/profil.php';
         break; 
      case '/?bibliographie':
         require 'template/bibliographie.php';
         break; 
      default :
         require 'template/filter.php';
         break;
   }

   require_once 'elements/footer.php';
  $dbh=null;
   ?>
