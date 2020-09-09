<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Verifikacija Korimena';
include "$direktorij/zaglavlje.php";
$veza = new Baza();
$veza->spojiDB();
if (isset($_POST['korime'])) {
    $korime = $_POST['korime'];
    if (!empty($korime)) {
        $stmt = $veza->spojiDB()->prepare("SELECT *
                                           FROM Korisnik
                                           WHERE korisnicko_ime = ?");
        $stmt->bind_param('s', $korime);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows === 0) {
            echo '<span id="boja" style="display:none">green</span>';
        } else {
            echo '<span id="boja" style="display:none">red</span>';
        }
    }
} else {
    die("nesto je poslo po krivom");
}
