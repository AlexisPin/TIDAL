<?php
    $selected = [];

    $sql = "SELECT * FROM public.meridien;";
    $dbh->beginTransaction();
    $meridiens = $dbh->prepare($sql);
    $meridiens->execute();
    $meridiens_data = $meridiens->fetchAll();
    $dbh->commit(); 

?>
<form action="?filter" class="filter-container" method="POST">
    <div class="sidebar">
        <div class="filter-header">
            <h1>Filtres</h1>
            <input type="submit" class="filter-submit" value="Filtrer">
        </div>
        <div class="meridien">
            <h3>Méridien</h3>
            <select name="meridien[]" id="meridien-select" multiple>
                <option value="">--Choisissez un méridien--</option>
                <?php foreach($meridiens_data as $meridien): 
                    if(isset($_POST['meridien']))
                    {
                        $selected = $_POST['meridien'];
                    }
                    ?>
                <option value="<?=$meridien['code'];?>"
                    <?php if(in_array($meridien['code'],$selected)){echo "selected";}?>><?=$meridien['nom'];?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="type">
            <h3>Type de pathologie</h3>
            <select name="type[]" id="type-select" multiple>
                <option value="">--Choisissez un type de pathologie--</option>
                <option value="m">méridien</option>
                <option value="tf">organe/viscère</option>
                <option value="l">voie luo</option>
                <option value="mv">merveilleux vaisseaux</option>
                <option value="j">jing jin</option>
            </select>
        </div>
        <div class="caracteristique">
            <h3>Caractéristiques</h3>
            <select name="caracteristique[]" id="caracteristique-select" multiple>
                <option value="">--Choisissez une caractéristique--</option>
                <option value="p">plein</option>
                <option value="c">chaud</option>
                <option value="v">vide</option>
                <option value="f">froid</option>
                <option value="i">interne</option>
                <option value="e">externe</option>
            </select>
        </div>
    </div>
</form>
<div class="result">
    <?php
if(isset($_POST['meridien']) || isset($_POST['type']) || isset($_POST['caracteristique']))
{
    $current_condition = [isset($_POST['meridien']),isset($_POST['type']),isset($_POST['caracteristique'])];
    $conditions = [[false,false,true],[false,true,false],[false,true,true],[true,false,false],[true,false,true],[true,true,false],[true,true,true]];
    console_log($current_condition);
    console_log($conditions[3]);
    switch($current_condition){
        case $conditions[0] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.type LIKE (:caract);";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':caract' => "%$type_filter%"));
            break;
        case $conditions[1] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.type LIKE (:types);";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':types' => "%$type_filter%"));
            break;
        case $conditions[2] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.type LIKE (:types) AND LIKE (:caract);";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':types' => "%$type_filter%",':caract' => "%$type_filter%"));
            break;
        case $conditions[3] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.mer IN (:meridiens);";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':meridiens' => "$type_filter"));
            break;
        case $conditions[4] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:caract) ;";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':meridiens' => "$type_filter",':caract' => "%$type_filter%"));
            break;
        case $conditions[5] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:types) ;";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':meridiens' => "$type_filter",':types' => "%$type_filter%"));
            break;
        case $conditions[6] : 
            $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
            INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS 
            WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:types) AND t2.type LIKE (:caract) ;";
            $dbh->beginTransaction();
            $pathos_meridiens = $dbh->prepare($sql);
            $pathos_meridiens->execute(array(':meridiens' => "$type_filter",':types' => "%$type_filter%",':caract' => "%$type_filter%"));
            break;    
    }                 

    $filterChecked = [];
    $filterChecked = array($_POST['meridien'], $_POST['type'], $_POST['caracteristique']);
    foreach($filterChecked as $type_filter)
    {
        console_log($type_filter);
        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
        $dbh->commit(); 

        //Rajouter if si pas de résultat
        foreach($pathos_meridiens_data as $nom_meridien)
        {
        ?>
    <a href="#">
        <div class="patho">
            <h4><?= $nom_meridien['pathologie'];?></h4>
            <p><?= $nom_meridien['meridien'];?></p>
            <p><?= $nom_meridien['symptome'];?></p>
        </div>
    </a>
    <?php
        }
    }
}else
{
    $sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS;";
    $dbh->beginTransaction();
    $pathos_meridiens = $dbh->prepare($sql);
    $pathos_meridiens->execute();
    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
    $dbh->commit(); 
    foreach($pathos_meridiens_data as $nom_meridien)
    {
        ?>
    <a href="#">
        <div class="patho">
            <h4><?= $nom_meridien['pathologie'];?></h4>
            <p>Méridien : <?= $nom_meridien['meridien'];?></p>
            <p>Symptome : <?= $nom_meridien['symptome'];?></p>
        </div>
    </a>
    <?php
    }
}
?>
</div>