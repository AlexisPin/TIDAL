<?php


$pathologie = new Pathologie($dbh);

$pathologie->id = intval($_GET["id"]);
$result = $pathologie->read_single();

if ($result) {
    $symptomes = explode("-", $result['symptome']);
?>
    <div class="single_patho">
        <div class="onePatho">
            <span class="subtitle">
                <h4>Pathologie : </h4>
                <p><?= $result['pathologie']; ?></p>
            </span>
            <span class="subtitle">
                <h4>Meridien : </h4>
                <p><?= $result['meridien']; ?></p>
            </span>
            <h4>Liste des symptomes : </h4>
            <div class="symptome-container">
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
