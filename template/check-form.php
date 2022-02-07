<div class="search-form">
    <form action="?check-form" method="POST" autocomplete="off">
        <input type="search" name="search" placeholder="Rechercher une pathologie ...">
        <input type="submit" name="submit-search">
    </form>
</div>

<?php
if (isset($_POST["submit-search"]))
{
 $_POST["search"] = htmlspecialchars($_POST["search"]); //sécurise faille html
 $search = $_POST["search"];
 $search = trim($search); //supprime les espaces
 $search = strip_tags($search); //supprime les balise html
 $search = strtolower($search);

 $sql = "SELECT name FROM public.keywords WHERE name LIKE :search";
 $dbh->beginTransaction();
 $result = $dbh->prepare($sql);
 $result->execute(array(':search' => "%$search%"));
 $queryResult = $result->fetchAll();
 $dbh->commit();

 $count = $result->rowCount();

 echo $count;
}
?>

<div class="pathologie-container">
       <?php foreach($queryResult as $keyword): ?>
        <a href="#">
            <div class="patho">
                <h4><?= $keyword['name'];?></h4>
            </div>
        </a>
        <?php endforeach; ?>
</div>
