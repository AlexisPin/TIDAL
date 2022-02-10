<div class="search-form">
    <form action="?check-form" method="POST">
        <input type="search" name="search" placeholder="Rechercher une pathologie ...">
        <input type="submit" name="submit-search" value="Rechercher">
    </form>
</div>

<?php 
       $sql = "SELECT name as keywords, t6.nom as meridien, t3.desc as symptome, t5.desc as pathologie  FROM public.keywords t1 INNER JOIN public.keySympt t2 ON t1.idK = t2.idK INNER JOIN public.symptome t3 ON t2.idS=t3.idS 
INNER JOIN public.symptPatho t4 ON t3.idS=t4.idS INNER JOIN public.patho t5 ON t4.idP=t5.idP INNER JOIN public.meridien t6 ON t5.mer = t6.code ORDER BY pathologie";
       $dbh->beginTransaction();
       $result = $dbh->prepare($sql);
       $result->execute();
       $queryResult = $result->fetchAll();
       $dbh->commit();
       ?>

<h2>Toutes les pathologies : </h2>
<div class="pathologie-container">
       <?php foreach($queryResult as $patho_meridien): ?>
        <a href="#">
            <div class="patho">
                <h4><?= $patho_meridien['pathologie'];?></h4>
                <p><?= $patho_meridien['meridien'];?></p>
                <p><?= $patho_meridien['symptome'];?></p>
            </div>
        </a>
        <?php endforeach; ?>
</div>
