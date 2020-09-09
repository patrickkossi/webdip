<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Konfiguracija sustava';
include "$direktorij/zaglavlje.php";
if (!isset($_SESSION["uloga"])) {
    header("Location: $putanja/obrasci/prijava.php");
    exit();
} elseif (isset($_SESSION["uloga"]) && $_SESSION["uloga"] !== 3) {
    header("Location: $putanja/index.php");
    exit();
}
if (isset($_POST['postavke'])) {;
    $url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json";
    if (!($fp = fopen($url, 'r'))) {
        exit;
    }
    $string = fread($fp, 10000);
    $json = json_decode($string, false);
    $sati = $json->WebDiP->vrijeme->pomak->brojSati;
    $sati = (is_numeric($sati)) ? $sati : 0;
    fclose($fp);
    $var->konfiguracija = new stdClass();
    $var->konfiguracija->pomak = $sati;
    $string = json_encode($var);
    dodajRedak("Vrijeme pomaknuto za: $sati");
    $fp = fopen("$direktorij/json/konfiguracija.json", 'w');
    fwrite($fp, $string);
    fclose($fp);
}

$smarty->display('konfiguracija.tpl');
include "$direktorij/podnozje.php";
