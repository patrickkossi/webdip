<style>
    label {
        color: black;
    }
</style>
<main class="hero-section" style="height: 120%;">
    <div class="forma_prijava" id="profil" style="width:80%;">
        <div style="width: 100%; display: flex;justify-content:space-around;">
            <h2 class="forma_naslov" style="font-size:40px; margin: 10px; padding: 0;">Moj profil</h2>
            <h2 class="forma_naslov" style="font-size:40px; margin: 10px; padding: 0;">Postavke</h2>
        </div>
        <div style="display: flex; justify-content: space-around;">
            <div style="width: 55%;background-color: rgb(241, 241, 241);  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.22), 0 3px 6px rgba(0, 0, 0, 0.34);">
                <div class="popis_kompetencija" id="popis_kompetencija" style="display: flex; align-items: center; justify-content: center">
                    <label for="kategorija">Kategorija</label>
                    <select id="kompetencije_popis" style="color: black" name="kompetencije">
            </select><a onclick="dodajKompetenciju()" style="cursor: pointer;height: 30px;width:30px;padding:10px;margin: 5px;background-color: lightgreen;border-radius: 25px; display: flex; align-items: center; justify-content: center">
            <span style="font-size: 25px; color: black;">+</span></a>
                </div>
                <div >
                <hr>
                <p style="color: black;font-size: 30px; text-align: center; padding: 20px 0"> Moje kompetencije</p>
                <hr>
                <div id="moje_kompetencije">
                </div>
                </div>
        
            </div>
            <form action="../skripte/spremiProfil.php" method="POST" style="box-shadow: 0 3px 6px rgba(0, 0, 0, 0.22), 0 3px 6px rgba(0, 0, 0, 0.34); width: 40%;heigth: 100%;color: black;background-color: rgb(241, 241, 241);padding: 10px; display: flex;flex-direction:column; justify-content: center;align-content: flex-end;">
                <label>Ime</label>
                <input id="ime" name="ime" type="text" class="input-field" value="{$korisnik.ime}">
                <label>Prezime</label>
                <input id="prezime" name="prezime" type="text" class="input-field" value="{$korisnik.prezime}">
                <input style="display:none" id="korime" name="korime" type="text" class="input-field" value="{$korisnik.korisnicko_ime}">
                <input style="display:none" id="salt" name="salt" type="text" class="input-field" value="{$korisnik.salt}">

                <label>Email</label>
                <input id="email" name="email" type="text" class="input-field" value="{$korisnik.email}">
                <label>Lozinka</label>
                <div id="lozinkaPrikazi" style="display:flex; margin-top: 5px; flex-direction:row; border-bottom:solid 1px #999; height:40px">
				<input id="lozinka" style="border:none" name="lozinka" type="password" class="input-field" placeholder="Lozinka" required value={$korisnik.lozinka}>
                <p id="prikazi" style="cursor:pointer; height: 20px; margin:auto; color:gray; border:none; background:none">Prikazi</p>
				</div>
                <label>Potvrdi lozinku</label>
                <div id="lozinkaPrikazi" style="display:flex; margin-top: 5px; flex-direction:row; border-bottom:solid 1px #999; height:40px">
				<input id="lozinka_ponovo" style="border:none" name="lozinka_ponovo" type="password" class="input-field" placeholder="Lozinka" required value={$korisnik.lozinka}>
                <p id="prikazipon" style="cursor:pointer; height: 20px; margin:auto; color:gray; border:none; background:none">Prikazi</p>
				</div>
                <button class="submit-btn" id="submit" name="submit" type="submit" value="spremi">Spremi promjene</button>
            </form>
        </div>

    </div>
</main>