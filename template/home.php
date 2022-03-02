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

    const meridiensCombinations = {
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
        "Rte": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v', 'c', 'f']
        ],
        "C": [
            ['m', 'l', 'j', 'tf'],
            ['e', 'i', 'p', 'v']
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
            ['e', 'i', 'p', 'v']
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
            ['']
        ],
        "DaiM": [
            ['mv'],
            ['']
        ],
        "+QM": [
            ['mv'],
            ['']
        ],
        "-QM": [
            ['mv'],
            ['']
        ],
        "-WM": [
            ['mv'],
            ['']
        ],
        "+WM": [
            ['mv'],
            ['']
        ],
    }
    const typesCombinations = {
        'm': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F'],
            ['e', 'i']
        ],
        'tf': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F'],
            ['p', 'v', 'c', 'f']
        ],
        'l': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F', 'DM', 'RM'],
            ['p', 'v']
        ],
        'mv': [
            ["DM", "RM", "ChM", "DaiM", "+QM", "-QM", "-WM", "+WM"],
            ['']
        ],
        'j': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F'],
            ['']
        ]
    }
    const caracterisitiquesCombinations = {
        'p': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F', 'DM', 'RM'],
            ['l', 'tf']
        ],
        'c': [
            ['P', 'GI', 'E', 'Rte', 'IG', 'V', 'MC', 'TR', 'VB', 'F'],
            ['tf']
        ],
        'v': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F', 'DM', 'RM'],
            ['l', 'tf']
        ],
        'f': [
            ['P', 'GI', 'E', 'Rte', 'IG', 'V', 'MC', 'TR', 'VB', 'F'],
            ['tf']
        ],
        'i': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F'],
            ['m']
        ],
        'e': [
            ['P', 'GI', 'E', 'Rte', 'C', 'IG', 'V', 'R', 'MC', 'TR', 'VB', 'F'],
            ['m']
        ]
    }

    resetBtn.addEventListener('click', () => {
        meridienSelect.selectedIndex = -1;
        typeSelect.selectedIndex = -1;
        caracteristiqueSelect.selectedIndex = -1;
    });

    (function() {
        meridienSelect.addEventListener('change', (e) => {

            currentMeridien = meridiensCombinations[e.target.value];
            typeSelectOptions.forEach((optionType) => {
                if (!currentMeridien[0].includes(optionType.value)) {
                    optionType.disabled = true;
                    optionType.selected = false;
                } else optionType.disabled = false;
            })
            caracteristiqueSelectOptions.forEach((optionCaracteristique) => {
                if (!currentMeridien[1].includes(optionCaracteristique.value)) {
                    optionCaracteristique.disabled = true;
                    optionCaracteristique.selected = false;
                } else optionCaracteristique.disabled = false;
            });
        });
        typeSelect.addEventListener('change', (e) => {

            currentType = typesCombinations[e.target.value];
            meridienSelectOptions.forEach((optionMeridien) => {
                if (!currentType[0].includes(optionMeridien.value)) {
                    optionMeridien.disabled = true;
                    optionMeridien.selected = false;
                } else optionMeridien.disabled = false;


            })
            caracteristiqueSelectOptions.forEach((optionCaracteristique) => {
                if (!currentType[1].includes(optionCaracteristique.value)) {
                    optionCaracteristique.disabled = true;
                    optionCaracteristique.selected = false;
                } else optionCaracteristique.disabled = false;

            });
        });

        caracteristiqueSelect.addEventListener('change', (e) => {

            currentCaracteristique = caracterisitiquesCombinations[e.target.value];
            meridienSelectOptions.forEach((optionMeridien) => {
                if (!currentCaracteristique[0].includes(optionMeridien.value)) {
                    optionMeridien.disabled = true;
                    optionMeridien.selected = false;
                } else optionMeridien.disabled = false;


            })
            typeSelectOptions.forEach((optionType) => {
                if (!currentCaracteristique[1].includes(optionType.value)) {
                    optionType.disabled = true;
                    optionType.selected = false;
                } else optionType.disabled = false;

            });
        });
    })()
</script>