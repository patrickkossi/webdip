<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
$naslov = 'Moderiraj korisnika';

if (isset($_POST["odmoderiraj"])) {
    $veza = new Baza();
    $value = $_POST["odmoderiraj"];
    var_dump($value);
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET tipkorisnika_id = '1' WHERE korisnik_id = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt = $veza->spojiDB()->prepare("SELECT korisnicko_ime FROM Korisnik WHERE korisnik_id = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    while ($red = $rezultat->fetch_array()) {
        $korime = $red["korisnicko_ime"];
    }
    header("location:$putanja/privatno/korisnici.php");
    dodajRedak("Oduzet moderator korisniku: $korime");
    $veza->zatvoriDB();
}
if (isset($_POST["moderiraj"])) {
    $veza = new Baza();
    $value = $_POST["moderiraj"];
    var_dump($value);
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET tipkorisnika_id = '2' WHERE korisnik_id = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt = $veza->spojiDB()->prepare("SELECT korisnicko_ime FROM Korisnik WHERE korisnik_id = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    while ($red = $rezultat->fetch_array()) {
        $korime = $red["korisnicko_ime"];
    }
    header("location:$putanja/privatno/korisnici.php");
    dodajRedak("Dat moderator korisniku: $korime");
    $veza->zatvoriDB();
    $veza->zatvoriDB();
}

