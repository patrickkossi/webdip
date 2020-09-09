<?php

$konfiguracija = ispis_konfiguracije($direktorij);

$smarty->assign('konfiguracija', $konfiguracija);
$smarty->display('podnozje.tpl');