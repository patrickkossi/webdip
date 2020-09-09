<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
$naslov = 'Spremi profil';
if (isset($_POST['submit'])) {
    $veza = new Baza();
    $korime = mysqli_real_escape_string($veza->spojiDB(), $_POST['korime']);
    echo $korime . "<br>";
    $email = mysqli_real_escape_string($veza->spojiDB(), $_POST['email']);
    echo $email . "<br>";
    $ime = mysqli_real_escape_string($veza->spojiDB(), $_POST['ime']);
    echo $ime . "<br>";
    $prezime =  mysqli_real_escape_string($veza->spojiDB(), $_POST['prezime']);
    echo $prezime . "<br>";
    $salt =  mysqli_real_escape_string($veza->spojiDB(), $_POST['salt']);
    $lozinka =  mysqli_real_escape_string($veza->spojiDB(), $_POST['lozinka']);
    $ponlozinka =  mysqli_real_escape_string($veza->spojiDB(), $_POST['lozinka_ponovo']);
    if($lozinka === $ponlozinka){
        $lozinkaKriptirano = sha1($lozinka . $salt);
        $unos = "UPDATE Korisnik SET email=\"$email\", ime= \"$ime\", prezime=\"$prezime\", lozinka=\"$lozinka\", lozinka_sha1=\"$lozinkaKriptirano\" where korisnicko_ime=\"$korime\";";

    }else{
        $unos = "UPDATE Korisnik SET email=\"$email\", ime= \"$ime\", prezime=\"$prezime\"  where korisnicko_ime=\"$korime\";";
    }
    echo $unos . "<br>";
    mysqli_query($veza->spojiDB(), $unos);
}
header("Location: $putanja/obrasci/profil.php");