<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Kategorije';
include "$direktorij/zaglavlje.php";

if (isset($_POST['dodajKategoriju'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $novaKategorija = $_POST['novaKategorija'];
    if (!empty($novaKategorija)) {
        $stmt = $veza->spojiDB()->prepare("SELECT *
                                           FROM Kategorija
                                           WHERE naziv = ?");
        $stmt->bind_param('s', $novaKategorija);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows === 0) {
            $stmt = $veza->spojiDB()->prepare("INSERT INTO Kategorija (naziv) values (?)");
            $stmt->bind_param('s', $novaKategorija);
            $stmt->execute();
            dodajRedak("Dodana kategorija $novaKategorija");
        }
    }
}

$smarty->display('kategorije.tpl');
include "$direktorij/podnozje.php";
