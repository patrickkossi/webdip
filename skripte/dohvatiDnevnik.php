<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
$naslov = 'Dohvati dnevnik';
if (isset($_GET['dohvati'])) {
    $veza = new Baza();
    $veza->spojiDB();
    if(isset($_GET['pretraga'])){
        $pretraga = $_GET['pretraga'];
        $pretraga = "%" . $pretraga . "%";
    };
    $stmt = $veza->spojiDB()->prepare("SELECT * FROM Dnevnik Where vrijeme like ? order by vrijeme desc limit 0,15");
    $stmt->bind_param("s", $pretraga);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $dnevnik = array();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        array_push($dnevnik, $red);
    }
    header('Content-Type: application/json');
    echo json_encode($dnevnik);
}
if(isset($_POST['id'])){
    $veza = new Baza();
    $veza->spojiDB();
    $id = $_POST['id'];
    $stmt = $veza->spojiDB()->prepare("DELETE FROM Dnevnik WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
