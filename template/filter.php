<?php
   $sql = "SELECT * FROM public.patho;";
   $dbh->beginTransaction();

   $pathos = $dbh->prepare($sql);
   $pathos->execute();
   $pathos_data = $pathos->fetchAll();
   $dbh->commit(); 

   $sql = "SELECT * FROM public.meridien;";
   $dbh->beginTransaction();
   $meridiens = $dbh->prepare($sql);
   $meridiens->execute();
   $meridiens_data = $meridiens->fetchAll();
   $dbh->commit(); 

?>

<div class="sidebar">
    <h1>Filtres</h1>
    <div class="meridien">
        <h3>Meridien</h3>
        <select name="meridien" id="meridien-select">
            <option value="">--Choisissez un méridien--</option>
            <?php foreach($meridiens_data as $meridien): ?>
            <option value="<?=$meridien['nom'];?>"><?=$meridien['nom'];?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="type">
        <h3>Type</h3>
        <select name="meridien" id="meridien-select">
            <option value="">--Choisissez un méridien--</option>
            <?php foreach($meridiens_data as $meridien): ?>
            <option value="<?=$meridien['nom'];?>"><?=$meridien['nom'];?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="caracteristique">
        <h3>Caracteristique </h3>
        <li><a href="#">+ Pleins</a></li>
        <li><a href="#">+ Chaud</a></li>
        <li><a href="#">+ Vide</a></li>
    </div>
</div>

<div class="result">
    <?php foreach($pathos_data as $patho): ?>
    <a href="#">
        <div class="patho">
            <h4><?= $patho['desc'];?></h4>
            <p><?= $patho['idp'];?></p>
            <p><?= $patho['mer'];?></p>
        </div>
    </a>
    <?php endforeach; ?>
</div>