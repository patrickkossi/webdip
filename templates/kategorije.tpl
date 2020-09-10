<main class="hero-section">
    <div class="forma_kategorija" style="width:100%;height:100%;margin: auto">
    <div>
    <h2 class="forma_naslov_kategorije" >Dodaj kategoriju</h2>
        <form novalidate name="dodajKategoriju" id="dodajKategoriju" class="kategorija_forma" method="post"
            action="{$smarty.server.PHP_SELF}">
            <input id="novaKategorija" name="novaKategorija" type="text" class="input-field" placeholder="kategorija"
                required>
            <button type="submit" name="dodajKategoriju" value="dodajKategoriju" class="submit-btn">Spremi</button>
        </form>
    </div>
        
        <div id="popisModeratoraKategorija">
            <table class="korisnici_tablica" id='kategorijeModeratori'>
                <tr style="background: linear-gradient(to right, #ff105f, #BD1220">
                    <th style="color:white;">Kategorija</th>
                    <th style="color:white;">Moderator</th>
                </tr>
            </table>
        </div>
    </div>

</main>