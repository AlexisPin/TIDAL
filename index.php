<?php

function console_log($data)
{
   echo '<script>';
   echo 'console.log(' . json_encode($data) . ')';
   echo '</script>';
}
include_once 'config/Database.php';
include_once 'src/models/Pathologie.php';


$database = new Database();
$dbh = $database->connect();

if (isset($_GET['id'])) {
   $pathoId = $_GET['id'];
}

require_once 'src/components/header.php';

define('MAIN_PATH', getcwd());
require(MAIN_PATH . '/inc/smarty-4.0.4/libs/Smarty.class.php');
$Smarty = new Smarty();
$Smarty->setTemplateDir(MAIN_PATH . '/template');

$uri = $_SERVER['REQUEST_URI'];
require 'src/components/navbar.php';
switch ($uri) {
   case '/':
      require 'template/home.php';
      break;
   case '/?login':
      if ($flag_connexion) {
         header('Location: /');
      } else {
         require 'template/login.php';
      }
      break;
   case '/?search':
      if ($flag_connexion) {
         require 'template/search.php';
      } else {
         header('Location: /?login');
      }
      break;
   case '/?signup':
      if ($flag_connexion) {
         header('Location: /');
      } else {
         require 'template/signup.php';
      }
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
   case '/?pathologie&id=' . $pathoId:
      require 'template/pathologie.php';
      break;
   default:
      header('Location: /');
      break;
}
require_once 'src/components/footer.php';
$dbh = null;
