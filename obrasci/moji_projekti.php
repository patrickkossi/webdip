<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());


$naslov = "Moji projekti";
include "$direktorij/zaglavlje.php";
if (!isset($_SESSION["uloga"])) {
    header("Location: $putanja/obrasci/prijava.php");
    exit();
} elseif (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 1) {
    header("Location: $putanja/index.php");
    exit();
}
if (isset($_COOKIE['korime'])) {
    $korime = $_COOKIE['korime'];
$veza = new Baza();
$veza->spojiDB();
$stmt = $veza->spojiDB()->prepare("SELECT * FROM Korisnik k WHERE k.korisnicko_ime = ?");
$stmt->bind_param("s", $korime);
$stmt->execute();
$rezultat = $stmt->get_result();
if ($rezultat->num_rows === 1) {
    while( $red = mysqli_fetch_assoc( $rezultat)){
        $podaciProfil = $red; 
    }
}
$veza->zatvoriDB();
}

$smarty->assign('korisnik', $podaciProfil);
$smarty->display('moji_projekti.tpl');
include "$direktorij/podnozje.php";

