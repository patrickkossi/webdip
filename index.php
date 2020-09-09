<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();

$naslov = "Početna stranica";
include "$direktorij/zaglavlje.php";

$smarty->assign('naslov', $naslov);
$smarty->display('index.tpl');
include "$direktorij/podnozje.php";

