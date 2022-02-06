<?php

   // try {
   //    $dbh = new PDO('sqlite:example.db');
   // } catch (PDOException $e) {
   //    echo $e->getCode() . ' ' . $e->getMessage();
   // }
   
   // $sql = "SELECT * FROM Patho WHERE myField='value';";
   // $dbh->query( $sql );

   require 'elements/header.php';

   define('MAIN_PATH', getcwd());
   require(MAIN_PATH . '/inc/smarty-4.0.4/libs/Smarty.class.php');
   $Smarty = new Smarty();
   $Smarty->setTemplateDir(MAIN_PATH . '/template');
   $ConnectionPage = "pages/home.php";
   $SearchPage = "pages/search.php";
   $BiblioPage = "pages/bibliography.php";

   $Smarty->assign('ConnectionPage',$ConnectionPage);
   $Smarty->assign('SearchPage',$SearchPage);
   $Smarty->assign('BiblioPage',$BiblioPage);

   $uri = $_SERVER['REQUEST_URI'];
   require 'elements/navbar.php';
   if ($uri === '/filter') {
   require 'template/filter.php';
   } elseif ($uri === '/connexion') {
   require 'template/home.php';
   }

   require 'elements/footer.php';
 