<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Dohvati projekte';
require "$direktorij/baza.class.php";

if (isset($_POST['osvjezi'])) {
    $veza = new Baza();
    $veza->spojiDB();
        $korime = $_COOKIE['korime'];
    
    
    $stmt = $veza->spojiDB()->prepare("SELECT kor.korisnicko_ime, p.projekt_id,p.naziv as projektNaziv, p.opis as projektOpis, p.akronim, k.naziv FROM Projekt as p , Kategorija as k, Korisnik as kor, `Suradnik projekta` as sp where k.kategorija_id = p.kategorija_id and p.projekt_id = sp.projekt_id and sp.korisnik_id = kor.korisnik_id and kor.korisnicko_ime = ? ORDER by p.status");
    $stmt->bind_param("s", $korime);
    $stmt->execute();
    $rezultat = $stmt->get_result();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        
            echo '<div class="about_moji">
            <h2>
                ' . $red["akronim"] . ' - ' . $red["projektNaziv"] . '
            </h2>
            <p class="about_kategorija_moji">' . $red["naziv"] . '</p>
            <p class="about_opis_moji">' . $red["projektOpis"] . '</p>
            <a href="'.$putanja.'/obrasci/projekt.php?projektid='. $red["projekt_id"].'">
            <button class="about-btn">Saznaj više</button>
            </a>
        </div>';    
};

};