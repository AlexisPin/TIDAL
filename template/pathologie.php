<?php


$pathologie = new Pathologie($dbh);

$pathologie->id = intval($_GET["id"]);
$result = $pathologie->read_single();
$symptomes = explode("-", $result['symptome']);

?>
<div class="result" id='result_rch_avance'>
    <div class="patho">
        <h4><?= $result['pathologie']; ?></h4>
        <p><?= $result['meridien']; ?></p>
        <?php foreach ($symptomes as $symptome) {
        ?><p><?= $symptome; ?></p>
        <?php
        } ?>

    </div>
</div>