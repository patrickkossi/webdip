<main class="hero-section">
    <div class="forma_prijava" style="height:300px">
        <h2 class="forma_naslov" style="font-size:40px">Konfiguracija</h2>
			<form novalidate name="postavke" id="spremanjePostavki" class="input_forma" method="post" action="{$smarty.server.PHP_SELF}">
                <a style="color:#0d0d0d"  target='_blank' href="http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html">Virtualno vrijeme</a>
                <button type="submit" name="postavke" value="postavke" class="submit-btn">Spremi</button>
			</form>
        <a href="{$putanja}/dokumentacija/dnevnik.php" style="text-align: center;border-radius: 10px;margin-left: 150px; padding: 10px 20px;font-size: 20px; background-color: #ff105f">Dnevnik</a>
    </div>
</main>