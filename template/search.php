<div class="search-form">
    <form action="?search" method="POST">
        <input type="search" name="search" placeholder="Rechercher une pathologie ...">
        <input type="submit" name="submit-search" value="Rechercher">
    </form>
</div>

<?php
require 'src/controller/searchResult.php';
?>

<div class="result" id='result_rch_avance'>
    <?php
    foreach ($result as $patho) {
    ?>
        <a href='/?pathologie&id=<?= strval($patho['id']); ?>'>
            <div class="patho">
                <h4><?= $patho['pathologie']; ?></h4>
                <p>Méridien : <?= $patho['meridien']; ?></p>
            </div>
        </a>
    <?php
    }
    ?>
</div>