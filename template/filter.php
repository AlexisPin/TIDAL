<?php

   $sql = "SELECT * FROM public.meridien;";
   $dbh->beginTransaction();
   $meridiens = $dbh->prepare($sql);
   $meridiens->execute();
   $meridiens_data = $meridiens->fetchAll();
   $dbh->commit(); 

   $sql = "SELECT * FROM public.meridien INNER JOIN public.patho ON public.meridien.code = public.patho.mer;";
   $dbh->beginTransaction();
   $pathos_meridiens = $dbh->prepare($sql);
   $pathos_meridiens->execute();
   $pathos_meridiens_data = $pathos_meridiens->fetchAll();
   $dbh->commit(); 

?>

<div class="sidebar">
    <h1>Filtres</h1>
    <div class="meridien">
        <h3>Meridien</h3>
        <select name="meridien" id="meridien-select" multiple>
            <option value="">--Choisissez un méridien--</option>
            <?php foreach($meridiens_data as $meridien): ?>
            <option value="<?=$meridien['nom'];?>"><?=$meridien['nom'];?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="type">
        <h3>Type de pathologie</h3>
        <select name="type" id="type-select" multiple>
            <option value="">--Choisissez un type de pathologie--</option>
            <option value="méridien">méridien</option>
            <option value="organe/viscère">organe/viscère</option>
            <option value="luo">voie luo</option>
            <option value="merveilleux vaisseaux">merveilleux vaisseaux</option>
            <option value="jing jin">jing jin</option>
        </select>
    </div>
    <div class="caracteristique">
        <h3>Caractéristiques</h3>
        <!-- <li><a href="#">+ Pleins</a></li>
        <li><a href="#">+ Chaud</a></li>
        <li><a href="#">+ Vide</a></li> -->
        <select name="type" id="caracteristique-select" multiple>
            <option value="">--Choisissez une caractéristique--</option>
            <option value="plein">plein</option>
            <option value="chaud">chaud</option>
            <option value="vide">vide</option>
            <option value="froid">froid</option>
            <option value="interne">interne</option>
            <option value="externe">externe</option>
        </select>
    </div>
</div>

<div class="result">
    <?php foreach($pathos_meridiens_data as $nom_meridien): ?>
    <a href="#">
        <div class="patho">
            <h4><?= $nom_meridien['desc'];?></h4>
            <p><?= $nom_meridien['nom'];?></p>
            <p><?= $nom_meridien['idp'];?></p>
        </div>
    </a>
    <?php endforeach; ?>
</div>