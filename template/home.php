<?php
$selected = [];
$typeList = ['m' => "méridien", 'tf' => "organe/viscère", 'l' => "voie luo", 'mv' => "merveilleux vaisseaux", 'j' => "jing jin"];
$caracteristicList = ['p' => 'plein', 'c' => 'chaud', 'v' => 'vide', 'f' => 'froid', 'i' => 'interne', 'e' => 'externe'];

$pathologie = new Pathologie($dbh);

?>

<form action="" class="filter-container" method="POST">
    <div class="sidebar">
        <div class="filter-header">
            <h1>Filtres</h1>
        </div>
        <div class="select_box">
            <h3>Méridien</h3>
            <select name="meridien[]" id="meridien-select" multiple>
                <?php
                if (isset($_POST['meridien'])) {
                    $selected = $_POST['meridien'];
                }
                $meridiens_data = $pathologie->getMeridiens();
                foreach ($meridiens_data as $meridien) { ?>
                    <option id="meridien-option" value="<?= $meridien['code']; ?>" <?php if (in_array($meridien['code'], $selected)) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $meridien['nom']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="select_box">
            <h3>Type de pathologie</h3>
            <select name="type[]" id="type-select" multiple>
                <?php
                if (isset($_POST['type'])) {
                    $selected = $_POST['type'];
                }
                foreach ($typeList as $type => $value) { ?>
                    <option id="type-option" value="<?= $type; ?>" <?php if (in_array($type, $selected)) {
                                                                        echo "selected";
                                                                    } ?>><?= $value; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="select_box">
            <h3>Caractéristiques</h3>
            <select name="caracteristique[]" id="caracteristique-select" multiple>
                <?php
                if (isset($_POST['caracteristique'])) {
                    $selected = $_POST['caracteristique'];
                }
                foreach ($caracteristicList as $caracteristique => $value) { ?>
                    <option id="caracteristique-option" value="<?= $caracteristique; ?>" <?php if (in_array($caracteristique, $selected)) {
                                                                                                echo "selected";
                                                                                            } ?>><?= $value; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="zone_bouton">
            <input type="submit" class="btn" id="btn_filter" value="Filtrer" />
            <input type="submit" class="btn" id="btn_reset" value="Reset">
        </div>
    </div>

</form>
<div class="result">
    <?php
    if (isset($_POST['meridien']) || isset($_POST['type']) || isset($_POST['caracteristique'])) {
        $pathologies_data = $pathologie->filtre();
        foreach ($pathologies_data as $pathologie_data) {
    ?>
            <a href='/?pathologie&id=<?= strval($pathologie_data['id']); ?>'>
                <div class="patho">
                    <h4><?= $pathologie_data['pathologie']; ?></h4>
                    <p><?= $pathologie_data['meridien']; ?></p>
                </div>
            </a>
        <?php
        }
    } else {
        $pathologies_data = $pathologie->read();
        foreach ($pathologies_data as $pathologie_data) {
        ?>
            <a href='/?pathologie&id=<?= strval($pathologie_data['id']); ?>'>
                <div class="patho">
                    <h4><?= $pathologie_data['pathologie']; ?></h4>
                    <p>Méridien : <?= $pathologie_data['meridien']; ?></p>
                </div>
            </a>
    <?php
        }
    }
    ?>
</div>

<script type="text/javascript">
    const resetBtn = document.getElementById('btn_reset');

    const meridienSelectOptions = document.querySelectorAll('#meridien-option');
    const caracteristiqueSelectOptions = document.querySelectorAll('#caracteristique-option');
    const typeSelectOptions = document.querySelectorAll('#type-option');

    const meridienSelect = document.getElementById('meridien-select');
    const typeSelect = document.getElementById('type-select');
    const caracteristiqueSelect = document.getElementById('caracteristique-select');

    const combinations = {
        "P": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "GI": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "E": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "RTe": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "C": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "IG": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "V": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "R": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "MC": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "TR": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "VB": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "F": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "DM": [
            ['mv', 'l'],
            ['p', 'v']
        ],
        "RM": [
            ['mv', 'l'],
            ['p', 'v']
        ],
        "ChM": [
            ['mv'],
            []
        ],
        "DaiM": [
            ['mv'],
            []
        ],
        "+QM": [
            ['mv'],
            []
        ],
        "-QM": [
            ['mv'],
            []
        ],
        "-WM": [
            ['mv'],
            []
        ],
        "+WM": [
            ['mv'],
            []
        ],
    }

    resetBtn.addEventListener('click', () => {
        meridienSelect.selectedIndex = -1;
        typeSelect.selectedIndex = -1;
        caracteristiqueSelect.selectedIndex = -1;
    });

    meridienSelectOptions.forEach((optionMeridien) => {
        optionMeridien.addEventListener('click', (e) => {
            switch (e.target.value) {
                case 'DM': {
                    typeSelectOptions.forEach((optionType) => {
                        if (optionType.value != 'mv' && optionType.value != 'l') optionType.disabled = true;
                    })
                    caracteristiqueSelectOptions.forEach((optionCaracteristique) => {
                        optionCaracteristique.disabled = true;
                    });

                };
            case 'RM':

            }
        });
    });

    typeSelectOptions.forEach((optionMeridien) => {
        optionMeridien.addEventListener('click', (e) => {
            switch (e.target.value) {
                case 'DM': {
                    typeSelectOptions.forEach((optionType) => {
                        if (optionType.value != 'mv' && optionType.value != 'l') optionType.disabled = true;
                    })
                    caracteristiqueSelectOptions.forEach((optionCaracteristique) => {
                        optionCaracteristique.disabled = true;
                    });

                };
            case 'RM':

            }
        });
    });

    caracteristiqueSelectOptions.forEach((optionMeridien) => {
        optionMeridien.addEventListener('click', (e) => {
            switch (e.target.value) {
                case 'DM': {
                    typeSelectOptions.forEach((optionType) => {
                        if (optionType.value != 'mv' && optionType.value != 'l') optionType.disabled = true;
                    })
                    caracteristiqueSelectOptions.forEach((optionCaracteristique) => {
                        optionCaracteristique.disabled = true;
                    });

                };
            case 'RM':

            }
        });
    });
</script>