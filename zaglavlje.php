<?php

require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";
require "$direktorij/vanjske_biblioteke/smarty-3.1.34/libs/Smarty.class.php";
    
Sesija::kreirajSesiju();
$smarty = new Smarty();


$smarty->setTemplateDir("$direktorij/templates")
        ->setCompileDir("$direktorij/templates_c")
        ->setPluginsDir(SMARTY_PLUGINS_DIR)
        ->setCacheDir("$direktorij/cache")
        ->setConfigDir("$direktorij/configs");

$smarty->assign('naslov', $naslov);
$smarty->assign('putanja', $putanja);
$smarty->display('zaglavlje.tpl');
function dodajRedak($poruka){
        $veza = new Baza();
        $veza->spojiDB();
        global $direktorij;
        $sada = ispis_konfiguracije($direktorij);
        $fp = fopen("$direktorij/dnevnik/dnevnik.log", "a+");
        $referer = $_SERVER["HTTP_REFERER"];
        fwrite($fp, $sada);
        fwrite($fp, ", ");
        fwrite($fp, $referer);
        fwrite($fp, ", ");
        fwrite($fp, $poruka);
        fwrite($fp, "\n ");
        fclose($fp);
        $stmt = $veza->spojiDB()->prepare("INSERT INTO Dnevnik (Vrijeme, Lokacija, Dogadaj) VALUES (?, ?, ?);");
        $stmt->bind_param("sss", $sada , $referer , $poruka);
        $stmt->execute();
    }

    function ispis_konfiguracije($direktorij)
    {
        $url = "$direktorij/json/konfiguracija.json";
        $fp = fopen($url, "r");
        $string = fread($fp, filesize($url));
        $json = json_decode($string, false);
        $sati = $json->konfiguracija->pomak;
        fclose($fp);
    
    
        $vrijeme_servera = time();
        $virtualno_vrijeme = $vrijeme_servera + ($sati * 60 * 60);
        $virtualno_vrijeme = date('d.m.Y. H:i:s', $virtualno_vrijeme);
    
        return $virtualno_vrijeme;
    }
    
