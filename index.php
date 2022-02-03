<?php
// Demarrage de la tamporisation (rien de s'affichera)
ob_start() ;
// On integre le contenu de la page
require_once('pages/nav_bar.php') ;
// On recupere dans une variable le contenu du tampon 
$contenu = ob_get_clean() ;
// On intégre le template qui utilise la variable $contenu 
require_once('template/template.php') ;
