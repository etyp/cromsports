<?php

include 'functions.php';

$driver = new DbDriver();
$results = $driver->getAll("sacks");

$encoded = json_encode($results);

echo $encoded;
die();

?>