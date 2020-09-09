<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
$naslov = 'Dohvati kategorije';
if (isset($_GET['dohvati'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("SELECT * FROM Kategorija");
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $kategorije = array();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        array_push($kategorije, $red['naziv']);
            
    }
    header('Content-Type: application/json');
    echo json_encode($kategorije);
}
