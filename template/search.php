<div class="search-form">
    <form action="?search" method="POST">
        <input type="search" name="search" placeholder="Rechercher une pathologie ...">
        <input type="submit" name="submit-search" value="Rechercher">
        <div class="radio-container">
            <input type="radio" name="select" value="keyword" id="keyword" checked />
            <label for="keyword" class="option keyword">
                <span>Mots clés</span>
            </label>
            <input type="radio" name="select" value="symptome" id="symptome" />
            <label for="symptome" class="option symptome">
                <span>Symptome</span>
            </label>
        </div>
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
                <h4>Pathologie : <?= $patho['pathologie']; ?></h4>
                <p>Méridien : <?= $patho['meridien']; ?></p>
            </div>
        </a>
    <?php
    }
    ?>
</div>