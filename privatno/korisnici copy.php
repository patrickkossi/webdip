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
$stmt = $veza->spojiDB()->prepare("SELECT k.korisnik_id,k.email,k.korisnicko_ime,k.lozinka,k.lozinka_sha1,k.status,k.tipkorisnika_id,tk.naziv FROM Korisnik k,`Tip Korisnika` tk where k.tipkorisnika_id = tk.tipkorisnika_id");
$stmt->execute();
$rezultat = $stmt->get_result();
while ($red = mysqli_fetch_assoc($rezultat)) {
    $ime[] = $red['korisnicko_ime'];
    $prezime[] = $red['email'];
    $korime[] = $red['lozinka'];
    $idkorisnika[] = $red['korisnik_id'];
    $tipkorisnika[] = $red['naziv'];
    $status[] = $red['status'];
    $tipid[] = $red['tipkorisnika_id'];
}
$brojRedaka = mysqli_num_rows($rezultat);
$veza->zatvoriDB();
$smarty->assign('ime', $ime);
$smarty->assign('prezime', $prezime);
$smarty->assign('korime', $korime);
$smarty->assign('idkorisnika', $idkorisnika);
$smarty->assign('tipkorisnika', $tipkorisnika);
$smarty->assign('tipid', $tipid);
$smarty->assign('status', $status);
$smarty->assign('brojRedaka', $brojRedaka);
$smarty->assign('naslov', $naslov);
$smarty->display('korisnici.tpl');
include "$direktorij/podnozje.php";
