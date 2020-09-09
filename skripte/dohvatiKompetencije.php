<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
$naslov = 'Dohvati kompetencije';
if (isset($_GET['dohvati'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("SELECT * FROM Kompetencije");
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $kompetencije = array();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        array_push($kompetencije, $red);
            
    }
    header('Content-Type: application/json');
    echo json_encode($kompetencije);
}
if (isset($_GET['skupi'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $korime = $_COOKIE['korime'];
    $stmt = $veza->spojiDB()->prepare("SELECT uk.korisnik_kompetencija, k.korisnicko_ime, ko.naziv FROM `Urednik Kompetencija` uk, Korisnik k, Kompetencije ko where uk.kompetencije_kompetencije_id = ko.kompetencije_id and uk.Korisnik_korisnik_id = k.korisnik_id and k.korisnicko_ime = ?");
    $stmt->bind_param("s", $korime);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $kompetencije = array();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        array_push($kompetencije, $red);
            
    }
    header('Content-Type: application/json');
    echo json_encode($kompetencije);
}
if(isset($_POST['id'])){
    $veza = new Baza();
    $veza->spojiDB();
    $id = $_POST['id'];
    $stmt = $veza->spojiDB()->prepare("DELETE FROM `Urednik Kompetencija` WHERE korisnik_kompetencija = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
if(isset($_POST['dodaj'])){
    $veza = new Baza();
    $veza->spojiDB();
    $id = $_POST['dodaj'];
    $korime = $_COOKIE['korime'];
    $stmt = $veza->spojiDB()->prepare("SELECT korisnik_id,kompetencije_id from Korisnik, Kompetencije where korisnicko_ime = ? and naziv = ?");
    $stmt->bind_param("ss", $korime, $id);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $korisnik = "";
    $kompetencijeid = "";
    while ($red = mysqli_fetch_assoc($rezultat)) {
        $korisnik = $red['korisnik_id'];
        $kompetencijeid = $red['kompetencije_id'];
    }
    $unos = "INSERT INTO `Urednik Kompetencija` (Kompetencije_kompetencije_id,Korisnik_korisnik_id) VALUES ('$kompetencijeid','$korisnik')";
    mysqli_query($veza->spojiDB(), $unos);
    echo $korisnik . $kompetencijeid;
}
//SELECT k.korisnicko_ime, ko.naziv FROM `Urednik Kompetencija` uk, Korisnik k, Kompetencije ko where uk.kompetencije_kompetencije_id = ko.kompetencije_id and uk.Korisnik_korisnik_id = k.korisnik_id and k.korisnicko_ime = "pkossi"