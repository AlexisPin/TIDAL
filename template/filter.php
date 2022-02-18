<?php
$selected = [];
$typeList = ['m' => "méridien", 'tf' => "organe/viscère", 'l' => "voie luo", 'mv' => "merveilleux vaisseaux", 'j' => "jing jin"];
$caracteristicList = ['p' => 'plein', 'c' => 'chaud', 'v' => 'vide', 'f' => 'froid', 'i' => 'interne', 'e' => 'externe'];

$sql = "SELECT * FROM public.meridien;";
$dbh->beginTransaction();
$meridiens = $dbh->prepare($sql);
$meridiens->execute();
$meridiens_data = $meridiens->fetchAll();
$dbh->commit();
$sql = "SELECT t1.code as code, t1.nom as meridien, t4.desc as symptome, t2.desc as pathologie, t2.type as type FROM public.meridien t1 
    INNER JOIN public.patho t2  ON t1.code = t2.mer INNER JOIN public.symptPatho t3 ON t2.idP=t3.idP INNER JOIN public.symptome t4 ON t3.idS=t4.idS ";

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
                <?php
                if (isset($_POST['meridien'])) {
                    $selected = $_POST['meridien'];
                    console_log($selected);
                }
                foreach ($meridiens_data as $meridien) { ?>
                    <option value="<?= $meridien['code']; ?>" <?php if (in_array($meridien['code'], $selected)) {
                                                                    echo "selected";
                                                                } ?>><?= $meridien['nom']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="type">
            <h3>Type de pathologie</h3>
            <select name="type[]" id="type-select" multiple>
                <option value="">--Choisissez un type de pathologie--</option>
                <?php
                if (isset($_POST['type'])) {
                    $selected = $_POST['type'];
                    console_log($selected);
                }
                foreach ($typeList as $type => $value) { ?>
                    <option value="<?= $type; ?>" <?php if (in_array($type, $selected)) {
                                                        echo "selected";
                                                    } ?>><?= $value; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="caracteristique">
            <h3>Caractéristiques</h3>
            <select name="caracteristique[]" id="caracteristique-select" multiple>
                <option value="">--Choisissez une caractéristique--</option>
                <?php
                if (isset($_POST['caracteristique'])) {
                    $selected = $_POST['caracteristique'];
                    console_log($selected);
                }
                foreach ($caracteristicList as $caracteristique => $value) { ?>
                    <option value="<?= $caracteristique; ?>" <?php if (in_array($caracteristique, $selected)) {
                                                                    echo "selected";
                                                                } ?>><?= $value; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</form>
<div class="result">
    <?php

    if (isset($_POST['meridien']) || isset($_POST['type']) || isset($_POST['caracteristique'])) {
        $current_condition = [isset($_POST['meridien']), isset($_POST['type']), isset($_POST['caracteristique'])];
        $conditions = [[false, false, true], [false, true, false], [false, true, true], [true, false, false], [true, false, true], [true, true, false], [true, true, true]];
        $filterChecked;
        switch ($current_condition) {
            case $conditions[0]:
                $filterChecked = $_POST['caracteristique'];
                $specified_sql =  "WHERE t2.type LIKE :caract;";
                $sql .= $specified_sql;
                foreach ($filterChecked as $type_filter) {
                    $dbh->beginTransaction();
                    $pathos_meridiens = $dbh->prepare($sql);
                    $pathos_meridiens->execute(array(':caract' => "%$type_filter%"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                    $dbh->commit();

                    //Rajouter if si pas de résultat
                    foreach ($pathos_meridiens_data as $nom_meridien) {
    ?>
                        <a href="#">
                            <div class="patho">
                                <h4><?= $nom_meridien['pathologie']; ?></h4>
                                <p><?= $nom_meridien['meridien']; ?></p>
                                <p><?= $nom_meridien['symptome']; ?></p>
                            </div>
                        </a>
                    <?php
                    }
                }
                break;
            case $conditions[1]:
                $filterChecked = $_POST['type'];
                $specified_sql =  "WHERE t2.type LIKE (:types);";
                $sql .= $specified_sql;
                foreach ($filterChecked as $type_filter) {
                    $dbh->beginTransaction();
                    $pathos_meridiens = $dbh->prepare($sql);
                    $pathos_meridiens->execute(array(':types' => "$type_filter%"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                    $dbh->commit();

                    //Rajouter if si pas de résultat
                    foreach ($pathos_meridiens_data as $nom_meridien) {
                    ?>
                        <a href="#">
                            <div class="patho">
                                <h4><?= $nom_meridien['pathologie']; ?></h4>
                                <p><?= $nom_meridien['meridien']; ?></p>
                                <p><?= $nom_meridien['symptome']; ?></p>
                            </div>
                        </a>
                    <?php
                    }
                }
                break;
            case $conditions[2]:
                $specified_sql = "WHERE t2.type LIKE (:comb);";
                $sql .= $specified_sql;
                $combinaisons = array();
                foreach ($_POST['type'] as $each_types) {
                    for ($i = 0; $i < sizeof($_POST['caracteristique']); $i++) {
                        $combinaisons[] = $each_types . $_POST['caracteristique'][$i];
                    }
                }
                foreach ($combinaisons as $combinaison) {
                    $dbh->beginTransaction();
                    $pathos_meridiens = $dbh->prepare($sql);
                    $pathos_meridiens->execute(array(':comb' => "$combinaison%"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                    $dbh->commit();

                    //Rajouter if si pas de résultat
                    foreach ($pathos_meridiens_data as $nom_meridien) {
                    ?>
                        <a href="#">
                            <div class="patho">
                                <h4><?= $nom_meridien['pathologie']; ?></h4>
                                <p><?= $nom_meridien['meridien']; ?></p>
                                <p><?= $nom_meridien['symptome']; ?></p>
                            </div>
                        </a>
                    <?php
                    }
                }
                break;
            case $conditions[3]:
                $filterChecked = $_POST['meridien'];
                $specified_sql =  "WHERE t2.mer IN (:meridiens);";
                $sql .= $specified_sql;
                foreach ($filterChecked as $type_filter) {
                    $dbh->beginTransaction();
                    $pathos_meridiens = $dbh->prepare($sql);
                    $pathos_meridiens->execute(array(':meridiens' => "$type_filter"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                    $dbh->commit();

                    //Rajouter if si pas de résultat
                    foreach ($pathos_meridiens_data as $nom_meridien) {
                    ?>
                        <a href="#">
                            <div class="patho">
                                <h4><?= $nom_meridien['pathologie']; ?></h4>
                                <p><?= $nom_meridien['meridien']; ?></p>
                                <p><?= $nom_meridien['symptome']; ?></p>
                            </div>
                        </a>
                        <?php
                    }
                }
                break;
            case $conditions[4]:
                $filterChecked = [$_POST['meridien'], $_POST['caracteristique']];
                $specified_sql = "WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:caract) ;";
                $sql .= $specified_sql;
                foreach ($filterChecked[0] as $each_meridien) {
                    foreach ($filterChecked[1] as $each_caract) {
                        $dbh->beginTransaction();
                        $pathos_meridiens = $dbh->prepare($sql);
                        $pathos_meridiens->execute(array(':meridiens' => "$each_meridien", ':caract' => "%$each_caract%"));
                        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                        $dbh->commit();

                        //Rajouter if si pas de résultat
                        foreach ($pathos_meridiens_data as $nom_meridien) {
                        ?>
                            <a href="#">
                                <div class="patho">
                                    <h4>Pathologie : <?= $nom_meridien['pathologie']; ?></h4>
                                    <p>Méridien : <?= $nom_meridien['meridien']; ?></p>
                                    <p>Symptome : <?= $nom_meridien['symptome']; ?></p>
                                </div>
                            </a>
                        <?php
                        }
                    }
                }
                break;
            case $conditions[5]:

                $filterChecked = [$_POST['meridien'], $_POST['type']];
                $specified_sql = "WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:types) ;";
                $sql .= $specified_sql;
                foreach ($filterChecked[0] as $each_meridien) {
                    foreach ($filterChecked[1] as $each_type) {
                        $dbh->beginTransaction();
                        $pathos_meridiens = $dbh->prepare($sql);
                        $pathos_meridiens->execute(array(':meridiens' => "$each_meridien", ':types' => "%$each_type%"));
                        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                        $dbh->commit();

                        //Rajouter if si pas de résultat
                        foreach ($pathos_meridiens_data as $nom_meridien) {
                        ?>
                            <a href="#">
                                <div class="patho">
                                    <h4>Pathologie : <?= $nom_meridien['pathologie']; ?></h4>
                                    <p>Méridien : <?= $nom_meridien['meridien']; ?></p>
                                    <p>Symptome : <?= $nom_meridien['symptome']; ?></p>
                                </div>
                            </a>
                        <?php
                        }
                    }
                }
                break;
            case $conditions[6]:
                console_log("ALL");
                $filterChecked = [$_POST['meridien'], $_POST['type'], $_POST['caracteristique']];
                $specified_sql = "WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:comb) ;";
                $sql .= $specified_sql;
                $combinaisons = array();
                foreach ($_POST['type'] as $each_types) {
                    for ($i = 0; $i < sizeof($_POST['caracteristique']); $i++) {
                        $combinaisons[] = $each_types . $_POST['caracteristique'][$i];
                    }
                }
                foreach ($filterChecked[0] as $each_meridien) {
                    foreach ($combinaisons as $combinaison) {
                        $dbh->beginTransaction();
                        $pathos_meridiens = $dbh->prepare($sql);
                        $pathos_meridiens->execute(array(':meridiens' => "$each_meridien", ':comb' => "%$combinaison%"));
                        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                        $dbh->commit();

                        //Rajouter if si pas de résultat
                        foreach ($pathos_meridiens_data as $nom_meridien) {
                        ?>
                            <a href="#">
                                <div class="patho">
                                    <h4>Pathologie : <?= $nom_meridien['pathologie']; ?></h4>
                                    <p>Méridien : <?= $nom_meridien['meridien']; ?></p>
                                    <p>Symptome : <?= $nom_meridien['symptome']; ?></p>
                                </div>
                            </a>
            <?php
                        }
                    }
                }
                break;
        }
    } else {
        $dbh->beginTransaction();
        $pathos_meridiens = $dbh->prepare($sql);
        $pathos_meridiens->execute();
        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
        $dbh->commit();
        foreach ($pathos_meridiens_data as $nom_meridien) {
            ?>
            <a href="#">
                <div class="patho">
                    <h4><?= $nom_meridien['pathologie']; ?></h4>
                    <p>Méridien : <?= $nom_meridien['meridien']; ?></p>
                    <p>Symptome : <?= $nom_meridien['symptome']; ?></p>
                </div>
            </a>
    <?php
        }
    }
    ?>
</div>