<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

$naslov = 'Dohvati projekte';
require "$direktorij/baza.class.php";

if (isset($_POST['osvjezi'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $kolicina = 0;
    $po_stranici = 6;
    if(isset($_POST['stranica'])){
        $trenutna_stranica = $_POST['stranica'];
    }else{
        $trenutna_stranica = 1; 
    }
    $pocetak = ($trenutna_stranica - 1) * $po_stranici;
    $stmt = $veza->spojiDB()->prepare("SELECT p.galerija, p.projekt_id,p.status, p.minimalni_iznos, p.prikupljeno,p.naziv as projektNaziv, p.opis as projektOpis, p.akronim,p.status, k.naziv FROM Projekt as p , Kategorija as k where k.kategorija_id = p.kategorija_id ORDER by p.status Limit $pocetak, $po_stranici ");
    $stmt->execute();
    $rezultat = $stmt->get_result();
    while ($red = mysqli_fetch_assoc($rezultat)) {
        
            echo '<div class="about">
            <h2>
                ' . $red["akronim"] . ' - ' . $red["projektNaziv"] . '
            </h2>
            <p class="about_kategorija">' . $red["naziv"] . '</p>';
            if($red["status"] == "0" && $red["minimalni_iznos"] > $red["prikupljeno"]) {
                $kolicina++;
                echo '<p style="background-color:green; padding: 5px; border-radius: 5px;"> Treba donacija</p>'; 
            }else{
                echo '<p style="background-color:red; padding: 5px; border-radius: 5px;"> Nije moguća donacija</p>'; 
            };
            echo '<p class="about_opis">' . $red["projektOpis"] . '</p>';
            if($red["galerija"] == 1){
                echo '<iframe width="420" height="315" style="margin-bottom: 10px; display:block" src="https://www.youtube.com/embed/DKM453G3oFQ?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" ></iframe>';
            }else{
                echo '<p style="color: black;margin-bottom: 20px" >Videozapis nije dostupan</p>';
            }
            echo '<a href="'.$putanja.'/obrasci/projekt.php?projektid='. $red["projekt_id"].'"><button class="about-btn">Saznaj više</button></a>
        </div>';    
};
echo '<script>document.getElementById("numDonacija").innerHTML = "Za doniranje: '.$kolicina.'"</script>';

echo '<script>document.getElementById("gumb'.$trenutna_stranica.'").classList.add("selektiran_gumb");</script>';
};