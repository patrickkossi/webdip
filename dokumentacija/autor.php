<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());


$naslov = "O autoru";
include "$direktorij/zaglavlje.php";

$smarty->display('autor.tpl');
include "$direktorij/podnozje.php";

