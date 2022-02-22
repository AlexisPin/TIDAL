<div class="search-form">
    <form action="?search" method="POST">
        <input type="search" name="search" placeholder="Rechercher une pathologie ...">
        <input type="submit" name="submit-search" value="Rechercher">
    </form>
</div>

<?php
require 'src/model/searchResult.php';
?>

<div class="result">
    <?php foreach ($queryResult as $each_result) { ?>
        <a href="#">
            <div class="patho">
                <h4>Pathologie : <?= $each_result['pathologie']; ?></h4>
                <p>Méridien : <?= $each_result['meridien']; ?></p>
                <p>Symptome : <?= $each_result['symptome']; ?></p>
            </div>
        </a>
    <?php } ?>
</div>