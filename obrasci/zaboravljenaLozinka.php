<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Zaboravljena lozinka';
include "$direktorij/zaglavlje.php";
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
if (isset($_GET['submit'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $email= ($_GET['email']);
    $stmt = $veza->spojiDB()->prepare("SELECT * FROM Korisnik WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $lozinka = generirajString();
    $salt = generirajString();
    $lozinkasha = sha1($lozinka . $salt);
    $rezultat = $stmt->get_result();
    if($rezultat->num_rows > 0){
        $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET lozinka = ?, lozinka_sha1 = ?, salt = ? WHERE email = ?");
        $stmt->bind_param("ssss", $lozinka,$lozinkasha,$salt, $email);
        $stmt->execute();
        $to = $email;
        $from = 'From: pkossi@foi.hr';
        $subject = 'Nova lozinka';
        $text = "Vasa nova lozinka je $lozinka";
        mail($to, $subject, $text, $from);
        header("Location: $putanja/index.php");
        dodajRedak("Reset lozinke $email");
    }
}
$smarty->display('zaboravljenaLozinka.tpl');
include "$direktorij/podnozje.php";
