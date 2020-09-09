<?php 
    $putanja = dirname($_SERVER['REQUEST_URI'], 2);
    $direktorij = dirname(getcwd());
    require "$direktorij/baza.class.php";

    $veza = new Baza();
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("SELECT k.naziv as nazivKategorije from Kategorija k");
    $stmt->execute();
    $rezultat = $stmt->get_result();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        echo '<tr class="tablica_redak">
        <td class="tablica_stvar">'.$red['nazivKategorije'].'</td>
        </tr>';
    };
    /*$veza = new Baza();
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("SELECT m.korisnicko_ime as moderatorKategorije, k.naziv as nazivKategorije from Kategorija k, Korisnik m, `Moderator Kategorije` mk WHERE mk.korisnik_id = m.korisnik_id AND mk.kategorija_id = k.kategorija_id;");
    $stmt->execute();
    $rezultat = $stmt->get_result();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        echo '<tr class="tablica_redak">
        <td class="tablica_stvar">'.$red['nazivKategorije'].'</td>
        <td class="tablica_stvar">'.$red['moderatorKategorije'].'</td>
        </tr>';
    };
*/