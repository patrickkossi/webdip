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
$veza = new Baza();
$veza->spojiDB();
$stmt = $veza->spojiDB()->prepare("SELECT * FROM Korisnik JOIN ");
$stmt->execute();
$rezultat = $stmt->get_result();
while( $red = mysqli_fetch_assoc( $rezultat)){
	$ime[] = $red['ime']; 
	$prezime[] = $red['lozinka'];
	$korime[] = $red['korisnicko_ime'];
	$idkorisnika[] = $red['korisnik_id'];
}
$brojRedaka = mysqli_num_rows($rezultat);
$veza->zatvoriDB();
$smarty->assign('ime', $ime);
$smarty->assign('prezime', $prezime);
$smarty->assign('korime', $korime);
$smarty->assign('idkorisnika', $idkorisnika);
$smarty->assign('brojRedaka', $brojRedaka);
$smarty->assign('naslov', $naslov);
$smarty->display('korisnici.tpl');
$smarty->display('podnozje.tpl');





