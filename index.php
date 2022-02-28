<?php

function console_log($data)
{
   echo '<script>';
   echo 'console.log(' . json_encode($data) . ')';
   echo '</script>';
}
require_once 'config/connectDB.php';

$database = new Database();
$dbh = $database->connect();

require_once 'elements/header.php';

define('MAIN_PATH', getcwd());
require(MAIN_PATH . '/inc/smarty-4.0.4/libs/Smarty.class.php');
$Smarty = new Smarty();
$Smarty->setTemplateDir(MAIN_PATH . '/template');

$uri = $_SERVER['REQUEST_URI'];
require 'elements/navbar.php';

switch ($uri) {
   case '/?filter':
      require 'template/filter.php';
      break;
   case '/?login':
      require 'template/login.php';
      break;
   case '/?search':
      if ($flag_connexion) {
         require 'template/search.php';
      } else {
         require 'template/login.php';
      }
      break;
   case '/?signup':
      require 'template/signup.php';
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
   default:
      require 'template/filter.php';
      break;
}
require_once 'elements/footer.php';
$dbh = null;
