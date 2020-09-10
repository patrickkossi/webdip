<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{$naslov}</title>
    <link rel="icon" href="{$putanja}/slike/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" type="text/css" href="{$putanja}/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{$putanja}/js/jquery.js"></script>
</head>

<body>
    <header class="header-main">
        <a href="{$putanja}/index.php"><img class="logo" src="{$putanja}/slike/logoWhite.png"></a>
        <nav class="header-navigation">
            <ul class="nav_links">
                <li><a href="{$putanja}/dokumentacija/autor.php">O autoru</a></li>
                <li><a href="{$putanja}/dokumentacija/dokumentacija.php">Dokumentacija</a></li>
                <li><a href="{$putanja}/privatno/korisnici.php">Korisnici</a></li>

                {if isset($smarty.session.uloga) && $smarty.session.uloga === 3 }
                    <li><a href="{$putanja}/obrasci/konfiguracija.php">Konfiguracija</a></li>
                    <li><a href="{$putanja}/obrasci/kategorije.php">Kategorije</a></li>
                {/if}
            </ul>
        </nav>
        {if isset($smarty.session.uloga) && $smarty.session.uloga >= 1 }
            <div class="nav_buttons">
                <a href="{$putanja}/obrasci/moji_projekti.php" class="nav_prijava"><u>Moji projekti</u></a>
                <a href="{$putanja}/obrasci/profil.php" class="nav_prijava"><u>Profil</u></a>
                <a class="nav_button" href="{$putanja}/obrasci/odjava.php"><button>Odjava</button></a>
            </div>
    
        {else}
            <div class="nav_buttons">
                <a href="{$putanja}/obrasci/prijava.php" class="nav_prijava"><u>Prijava</u></a>
                <a class="nav_button" href="{$putanja}/obrasci/registracija.php"><button>Registracija</button></a>
            </div>
        {/if}
    </header>
    <div class='cookie-banner' style='display: none;z-index:1000'>
        <p style="color:black">Korištenjem ove stranice prihvaćate uvjete korištenja </p>
        <button class='cookie-btn' id="zatvoriUvjete">prihvati</button>
    </div>