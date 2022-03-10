<?php

$pathologie = new Pathologie($dbh);
if (isset($_POST["submit-search"]) && $_POST["search"] != null) {
    $_POST["search"] = htmlspecialchars($_POST["search"]);
    $search = $_POST["search"];
    $search = trim($search);
    $search = strip_tags($search);
    $search = strtolower($search);
    $pathologie->research = $search;
    if ($_POST["select"] == "keyword") {
        $result = $pathologie->searchByKeyword();
    } else {
        $result = $pathologie->searchBySymptome();
    }
} else {
    $result = $pathologie->read();
}
