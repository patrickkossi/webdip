<?php
define('SITE_KEY', '6LcR1aIZAAAAANaQiIkqDc2Gpvxubx2yJFx2ZUxc');
define('SECRET_KEY', '6LcR1aIZAAAAABRZogLNX1e4a7LBiFnju8aWYTHm');
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = "Registracija";
include "$direktorij/zaglavlje.php";

$korime = '';
$email = '';
$ime = '';
$lozinka = '';
$prezime = '';

$slobodanEmail = null;
$slobodnoKorime = null;
$greske = array();

function generirajString($duljina = 10)
{
    $znakovi = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $duljinaZnakova = strlen($znakovi);
    $randomString = '';
    for ($i = 0; $i < $duljina; $i++) {
        $randomString .= $znakovi[rand(0, $duljinaZnakova - 1)];
    }
    return $randomString;
}

if (isset($_POST['submit'])) {
    //captcha
    $recaptcha_secret = "6LcR1aIZAAAAABRZogLNX1e4a7LBiFnju8aWYTHm";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST['g-recaptcha-response']);
    $response = json_decode($response, true);
    if ($response["success"] === true) {
        $veza = new Baza();
        $veza->spojiDB();
        $korime = mysqli_real_escape_string($veza->spojiDB(), $_POST['korime']);
        $lozinka = mysqli_real_escape_string($veza->spojiDB(), $_POST['lozinka']);
        $email = mysqli_real_escape_string($veza->spojiDB(), $_POST['email']);
        $ime = mysqli_real_escape_string($veza->spojiDB(), $_POST['ime']);
        $prezime = mysqli_real_escape_string($veza->spojiDB(), $_POST['prezime']);
        $salt = generirajString();
        //provjera
        if (empty($korime)) {
            array_push($greske, "Unesite korisničko ime");
        }
        if (empty($lozinka)) {
            array_push($greske, "Unesite lozinku");
        }
        if (empty($email)) {
            array_push($greske, "Unesite email");
        }
        if (empty($ime)) {
            array_push($greske, "Unesite početno ime");
        }
        if (empty($prezime)) {
            array_push($greske, "Unesite prezime");
        }

        if (!empty($korime)) {
            $stmt = $veza->spojiDB()->prepare("SELECT *
                                           FROM Korisnik
                                           WHERE korisnicko_ime = ?");
            $stmt->bind_param('s', $korime);
            $stmt->execute();
            $rezultat = $stmt->get_result();
            if ($rezultat->num_rows === 0) {
                $slobodnoKorime = 1;
            } else {
                $slobodnoKorime = 0;
                array_push($greske, "Korime zauzeto");
            }
        }
        if (!empty($email)) {
            $stmt = $veza->spojiDB()->prepare("SELECT *
                                           FROM Korisnik
                                           WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $rezultat = $stmt->get_result();
            if ($rezultat->num_rows === 0) {
                $slobodanEmail = 1;
            } else {
                $slobodanEmail = 0;
                array_push($greske, "Email zauzet");
            }
        }
        if (count($greske) == 0) {
            $lozinkaKriptirano = sha1($lozinka . $salt);
            $unos = "INSERT INTO Korisnik (tipkorisnika_id, email, ime, prezime, korisnicko_ime, lozinka, lozinka_sha1, salt, status) VALUES ('1', '$email', '$ime', '$prezime', '$korime', '$lozinka', '$lozinkaKriptirano', '$salt', '0')";
            mysqli_query($veza->spojiDB(), $unos);
            $to = $email;
            $from = 'From: pkossi@foi.hr';
            $subject = 'Email verifikacija';
            $text = "Za verifikaciju pritisnite link http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x067/obrasci/verifikacija.php?vkljuc=$salt";
            mail($to, $subject, $text, $from);
            header("Location: $putanja/index.php");
            dodajRedak("Registracija korisnika $email");
        }
        $veza->zatvoriDB();
    } else {
        var_dump($response);
    }
}


//spajanje na bazu

$smarty->assign('ime', $ime);
$smarty->assign('prezime', $prezime);
$smarty->assign('korime', $korime);
$smarty->assign('email', $email);
$smarty->assign('lozinka', $lozinka);
$smarty->assign('greske', $greske);
$smarty->assign('slobodanEmail', $slobodanEmail);
$smarty->assign('slobodnoKorime', $slobodnoKorime);
$smarty->display('registracija.tpl');
include '../podnozje.php';