<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
$naslov = 'Omoguci korisnika';

if (isset($_POST["onemoguci"])) {
    $veza = new Baza();
    $value = $_POST["onemoguci"];
    var_dump($value);
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET status = '0' WHERE korisnik_id = ?");
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
    dodajRedak("Onemogucen korisnik: $korime");
    $veza->zatvoriDB();
}
if (isset($_POST["omoguci"])) {
    $veza = new Baza();
    $value = $_POST["omoguci"];
    var_dump($value);
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET status = '1' WHERE korisnik_id = ?");
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
    dodajRedak("Onemogucen korisnik: $korime");
    $veza->zatvoriDB();
    $veza->zatvoriDB();
}

