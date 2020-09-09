<?php
    $putanja = dirname($_SERVER['REQUEST_URI'], 2);
    $direktorij = dirname(getcwd());
  
    $naslov = 'Odjava';
    include "$direktorij/zaglavlje.php";
    Sesija::obrisiSesiju();
    header("Location: $putanja/index.php");
