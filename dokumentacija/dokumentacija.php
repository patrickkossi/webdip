<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());


$naslov = "Dokumentacija";
include "$direktorij/zaglavlje.php";

$smarty->display('dokumentacija.tpl');
include "$direktorij/podnozje.php";

?>
