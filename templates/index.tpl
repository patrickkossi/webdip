<style>
    .statusprojekta1 {
        background-color: green;
        border-radius: 2px;
        padding: 2px;
    }

    .statusprojekta0 {
        background-color: yellow;
        border-radius: 2px;
        padding: 2px;
    }

    .statusprojekta2 {
        background-color: red;
        border-radius: 2px;
        padding: 2px;

    }
</style>
<main style="height: 60%;" class="hero-section">
    <div class="hero_data">
        <h1><span>H</span>-donacije<span style="color:#BD1220">.</span></h1>
        <p>Dobrodošli na početnu stranicu projekta</p>
    </div>
</main>

<div class="section_about" id="popis_projekata">
    <div class="naslov_projekata">
        <h2 class="galerija_naslov">Projekti:</h2>
        <div class="selektor_kategorija">
            <label for="kategorija">Kategorija</label>
            <select id="kategorija_projekta" name="kategorija">
            </select>
            <p style="padding:5px 0" id="numDonacija">Za doniranje: </p>

        </div>
        <div class="naslov_projekata-stuff">
            <input class="input-field" id="pretraga" placeholder="pretrazi">
        </div>
    </div>
    <div class="section_about-flex" id="projekti">
    </div>
    <div class="change_pages_container" id="change_pages_container">
        <p class="change_pages">
        <div class="select_page" onclick="ucitavanjeProjekta(1)" id="gumb1"><p class="change_pages" >1</p></div>
        <div class="select_page" onclick="ucitavanjeProjekta(2)" id="gumb2"><p class="change_pages" >2</p></div>
        </p>
    </div>
</div>