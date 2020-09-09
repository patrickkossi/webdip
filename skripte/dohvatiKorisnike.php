<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Dohvati korisike';
require "$direktorij/baza.class.php";

if (isset($_GET['osvjezi'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $stmt = $veza->spojiDB()->prepare("SELECT k.korisnik_id,k.email,k.korisnicko_ime,k.lozinka,k.lozinka_sha1,k.status,k.tipkorisnika_id,tk.naziv FROM Korisnik k,`Tip Korisnika` tk where k.tipkorisnika_id = tk.tipkorisnika_id order by k.korisnik_id");
    $stmt->execute();
    $rezultat = $stmt->get_result();
    $prikaz = '<div class="grid">
        <span class="grid_header">
            <strong >Id</strong>
        </span>
        <span class="grid_header">
            <strong>Korisnicko ime</strong>
        </span>
        <span class="grid_header">
            <strong>Email</strong>
        </span>
        <span class="grid_header">
            <strong>Lozinka</strong>
        </span>
        <span class="grid_header">
            <strong>Tip korisnika</strong>
        </span>
        <span class="grid_header">
            <strong>Lozinka kriptirano</strong>
        </span>
        <span class="grid_header">
            <strong>Status</strong>
        </span>
        <span class="grid_header">
            <strong>Moderiranje</strong>
        </span>
    ';
    while ($red = mysqli_fetch_assoc($rezultat)) {
            $prikaz .= '
            <span>'.$red["korisnik_id"].'</span>
            <span>'.$red["korisnicko_ime"].'</span>
            <span>'.$red["email"].'</span>
            <span>'.$red["lozinka"].'</span>
            <span>'.$red["naziv"].'</span>
            <span>'.$red["lozinka_sha1"].'</span>
            ';
                $prikaz .= '<span><form action="../obrasci/omoguciKorisnika.php" method="post">';
                if ($red['status'] != 1)
                $prikaz .= '<button class="submit-btn manji" name="omoguci" value="'.$red["korisnik_id"].'">Omoguci</button></form></span>';
                else 
                $prikaz .= '<button class="submit-btn manji" style="width:100%" name="onemoguci" value="'.$red["korisnik_id"].'">Onemoguci</button></form></span>';
                
                $prikaz .='<span><form action="../obrasci/moderirajKorisnika.php" method="post">';
                if ($red["tipkorisnika_id"] == 1){
                    $prikaz .= '<button class="submit-btn manji" name="moderiraj" value="'.$red["korisnik_id"].'">Moderiraj</button>';
                }elseif ($red["tipkorisnika_id"] == 2){
                    $prikaz .= '<button class="submit-btn manji" style="width:100%" name="odmoderiraj"  value="'.$red["korisnik_id"].'">Odmoderiraj</button>';
                }else {
                    $prikaz .= '<button class="submit-btn manji" style="width:100%;background: gray" disabled name="admin"  value="'.$red["korisnik_id"].'">Admin</button>';
                }
                $prikaz .= '</form></span>';
                    
                


    }
    $prikaz .= '</div>';
    echo $prikaz;
};