<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Prijava';
include "$direktorij/zaglavlje.php";
$greska = "";
$poruka = "";
$salt = "";
if (isset($_GET['submit'])) {
    //var_dump($_GET);
    $greska = "";
    $poruka = "";
    foreach ($_GET as $k => $v) {
        $v = filter_input(INPUT_GET, $k, FILTER_SANITIZE_STRING);
        if (empty($v)) {
            $greska .= "Nije popunjeno: " . $k . "<br>";
        }
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();



        $korime = mysqli_real_escape_string($veza->spojiDB(), $_GET['korime']);
        $lozinka = mysqli_real_escape_string($veza->spojiDB(), $_GET['lozinka']);

        $stmt = $veza->spojiDB()->prepare("SELECT salt FROM Korisnik WHERE korisnicko_ime = ?");
        $stmt->bind_param("s", $korime);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows > 0) {
            $red = $rezultat->fetch_assoc();
            $salt =  $red['salt'];
        }


        $lozinkaKriptirana = sha1($lozinka . $salt);

        $stmt = $veza->spojiDB()->prepare("SELECT * FROM Korisnik WHERE korisnicko_ime = ? AND lozinka_sha1 = ? AND status = '1'");
        $stmt->bind_param("ss", $korime, $lozinkaKriptirana);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows === 0) {
            $poruka = 'Nema rezultata!';
            $stmt = $veza->spojiDB()->prepare("SELECT * FROM Korisnik WHERE korisnicko_ime = ? AND status = '1'");
            $stmt->bind_param("s", $korime);
            $stmt->execute();
            $rezultat = $stmt->get_result();
            if ($rezultat->num_rows > 0) {
                $stmt = $veza->spojiDB()->prepare("SELECT pokusajiPrijave FROM Korisnik WHERE korisnicko_ime = ? AND status = '1'");
                $stmt->bind_param("s", $korime);
                $stmt->execute();
                $rezultat = $stmt->get_result();
                if ($rezultat->num_rows > 0) {
                    $rezultat = mysqli_fetch_array($rezultat);
                    $pokusajiPrijave = $rezultat['pokusajiPrijave'] + 1;
                    var_dump($pokusajiPrijave);
                    if ($pokusajiPrijave === 3) {
                        $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET status = '0',pokusajiPrijave = '0' WHERE korisnicko_ime = ?");
                        $stmt->bind_param("s", $korime);
                        $stmt->execute();
                    } else {
                        $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET pokusajiPrijave = ? WHERE korisnicko_ime = ?");
                        $stmt->bind_param("ss", $pokusajiPrijave, $korime);
                        $stmt->execute();
                    }
                }
            }
            $autenticiran = false;
        } else {


            while ($red = $rezultat->fetch_array()) {
                if ($red) {
                    $autenticiran = true;
                    $tip = $red["tipkorisnika_id"];
                }
            }
            if ($autenticiran) {
                if (empty($_COOKIE['autenticiran'])) {
                }
                $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET pokusajiPrijave = '0' WHERE korisnicko_ime = ?");
                $stmt->bind_param("s", $korime);
                $stmt->execute();
                $poruka = 'Uspješna prijava!';
                setcookie('korime', $korime, time() + (86400 * 30), "/");
                Sesija::kreirajKorisnika($korime, $tip);
                
if (isset($_COOKIE['location'])){
    $rip =  $_COOKIE['location'];
  header("Location: $rip");
}else{
    header("Location: $putanja/index.php");
}
                
                dodajRedak("Prijava $korime");
            } else {
                $poruka = 'Neuspješna prijava!';
            }
            $veza->zatvoriDB();
        }
    }
}
$korime123 = '';
if (isset($_COOKIE['korime'])){
    $korime123 =  $_COOKIE['korime'];
}
$smarty->assign('korime', $korime123);
$smarty->assign('lozinka', ' ');
$smarty->assign('greska', htmlspecialchars($greska, ENT_COMPAT, 'UTF-8'));
$smarty->assign('poruka', htmlspecialchars($poruka, ENT_COMPAT, 'UTF-8'));
$smarty->display('prijava.tpl');
include "$direktorij/podnozje.php";
