<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());


$naslov = "Dnevnik";
include "$direktorij/zaglavlje.php";

$smarty->display('dnevnik.tpl');
include "$direktorij/podnozje.php";

?>
