<?php

$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());


$naslov = "placeholder";
include "$direktorij/zaglavlje.php";

if (isset($_GET['projektid'])) {
    $projekt = $_GET['projektid'];
    $veza = new Baza();
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("SELECT * FROM Projekt WHERE projekt_id = ?");
    $stmt->bind_param("s", $projekt);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    if ($rezultat->num_rows === 1) {
        while( $red = mysqli_fetch_assoc( $rezultat)){
            $podaciProjekt = $red;
        }
    }
    $veza->zatvoriDB();
}

$smarty->assign('podaciProjekt', $podaciProjekt);
$smarty->display('projekt.tpl');
include "$direktorij/podnozje.php";
