<?php
if (isset($_POST["submit-search"]) && $_POST["search"] != null) {
    $_POST["search"] = htmlspecialchars($_POST["search"]); //sécurise faille html
    $search = $_POST["search"];
    $search = trim($search); //supprime les espaces
    $search = strip_tags($search); //supprime les balise html
    $search = strtolower($search);

    $sql = "SELECT DISTINCT t5.desc as pathologie, t6.nom as meridien, t3.desc as symptome FROM public.keywords t1 INNER JOIN public.keySympt t2 ON t1.idK = t2.idK INNER JOIN public.symptome t3 ON t2.idS=t3.idS 
 INNER JOIN public.symptPatho t4 ON t3.idS=t4.idS INNER JOIN public.patho t5 ON t4.idP=t5.idP INNER JOIN public.meridien t6 ON t5.mer = t6.code WHERE t1.name LIKE :search";
    $dbh->beginTransaction();
    $result = $dbh->prepare($sql);
    $result->execute(array(':search' => "%$search%"));
    $queryResult = $result->fetchAll();
    $dbh->commit();
    $count = $result->rowCount();
    $nbResult =  $count;

} else {

    $sql = "SELECT t5.desc as pathologie, t6.nom as meridien, t3.desc as symptome FROM public.keywords t1 INNER JOIN public.keySympt t2 ON t1.idK = t2.idK INNER JOIN public.symptome t3 ON t2.idS=t3.idS 
INNER JOIN public.symptPatho t4 ON t3.idS=t4.idS INNER JOIN public.patho t5 ON t4.idP=t5.idP INNER JOIN public.meridien t6 ON t5.mer = t6.code ORDER BY pathologie";
    $dbh->beginTransaction();
    $result = $dbh->prepare($sql);
    $result->execute();
    $queryResult = $result->fetchAll();
    console_log($queryResult);
    $dbh->commit();
?>
<?php
} ?>