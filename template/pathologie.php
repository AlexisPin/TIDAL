<?php


$pathologie = new Pathologie($dbh);

$pathologie->id = intval($_GET["id"]);
$result = $pathologie->read_single();

if ($result) {
    $symptomes = explode("-", $result['symptome']);
?>
    <div class="result" id='result_rch_avance'>
        <div class="patho">
            <h4><?= $result['pathologie']; ?></h4>
            <p>Pathologie : <?= $result['meridien']; ?></p>
            <div class="symptome-container">
                <h4>Liste des symptomes : </h4>
                <?php foreach ($symptomes as $symptome) {
                ?><p><?= $symptome; ?></p>
                <?php
                } ?>
            </div>
        </div>
    </div>
<?php
} else {
    header("Location: / ");
}
