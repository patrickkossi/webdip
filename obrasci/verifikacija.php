<?php
    $putanja = dirname($_SERVER['REQUEST_URI'], 2);
    $direktorij = dirname(getcwd());
  
    $naslov = 'Verifikacija';
    include "$direktorij/zaglavlje.php";
    if(isset($_GET['vkljuc'])){

        $vkey = $_GET['vkljuc'];
        $veza = new Baza();
        $veza->spojiDB();
        $stmt = $veza->spojiDB()->prepare("SELECT * FROM Korisnik WHERE salt = ? AND status = '0'");
        $stmt->bind_param("s", $vkey);
        $stmt->execute();
        $rezultat = $stmt->get_result();
            if ($rezultat->num_rows === 1) {
                $stmt = $veza->spojiDB()->prepare("UPDATE Korisnik SET status = '1' WHERE salt = ?");
                $stmt->bind_param("s", $vkey);
                $stmt->execute();
                $stmt = $veza->spojiDB()->prepare("SELECT korisnicko_ime FROM Korisnik WHERE salt = ?");
                $stmt->bind_param("s", $vkey);
                $stmt->execute();
                $rezultat = $stmt->get_result();
                while ($red = $rezultat->fetch_array()) {
                        $korime = $red["korisnicko_ime"];
                }
                header("Location: $putanja/index.php");
                dodajRedak("Verifikacija korisnika: $korime");
            }
        $veza->zatvoriDB();
    }else {
        die("nesto je poslo po krivom");
    }