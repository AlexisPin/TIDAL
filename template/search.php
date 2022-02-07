<div class="search-form">
    <form action="?check-form" method="POST">
        <input type="search" name="search" placeholder="Rechercher une pathologie ...">
        <input type="submit" name="submit-search">
    </form>
</div>

<?php 
       $sql = "SELECT * FROM public.meridien INNER JOIN public.patho ON public.meridien.code = public.patho.mer;";
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
                <h4><?= $patho_meridien['desc'];?></h4>
                <p><?= $patho_meridien['nom'];?></p>
                <p><?= $patho_meridien['idp'];?></p>
            </div>
        </a>
        <?php endforeach; ?>
</div>
