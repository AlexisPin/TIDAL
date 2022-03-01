<?php

$pathologie = new Pathologie($dbh);
if (isset($_POST["submit-search"]) && $_POST["search"] != null) {
    $_POST["search"] = htmlspecialchars($_POST["search"]);
    $search = $_POST["search"];
    $search = trim($search);
    $search = strip_tags($search);
    $search = strtolower($search);
    $pathologie->keyword = $search;
    $result = $pathologie->searchByKeyword();
} else {
    $result = $pathologie->read();
}
