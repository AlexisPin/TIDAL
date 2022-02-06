<?php
if (isset($_GET["terme"]) AND $_GET["s"] == "Rechercher")
{
 $_GET["terme"] = htmlspecialchars($_GET["terme"]); //sécurise faille html
 $terme = $_GET["terme"];
 $terme = trim($terme); //supprime les espaces
 $terme = strip_tags($terme); //supprime les balise html
}
if (isset($terme))
{
 $terme = strtolower($terme);
 $select_terme = $bdh->prepare("SELECT name FROM public.keywords WHERE name LIKE ? OR contenu LIKE ?");
 $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
}
else
{
 $message = "Vous devez entrer votre requete dans la barre de recherche";
}

while($terme_trouve = $select_terme->fetch())
{
echo "<div><h2>".$terme_trouve['idk']."</h2><p> ".$terme_trouve['name']."</p>";
}
$select_terme->closeCursor();