<?php

include 'functions.php';

// Get parameters
if (isset($_GET["tableToQuery"])) {
    $driver = new DbDriver();
    $limit = $_GET["limit"];
    $results = $driver->getAll($_GET["tableToQuery"]);

    $encoded = json_encode($results);

    echo $encoded;
}


die();

?>