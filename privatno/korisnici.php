<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());


$naslov = "Korisnici";
include "$direktorij/zaglavlje.php";
if (!isset($_SESSION["uloga"])) {
    header("Location: ../obrasci/prijava.php");
    exit();
} elseif (isset($_SESSION["uloga"]) && $_SESSION["uloga"] !== 3) {
    header("Location: ../index.php");
    exit();
}

$smarty->assign('naslov', $naslov);
$smarty->display('korisnici.tpl');
include "$direktorij/podnozje.php";
