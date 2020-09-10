<main class="hero-section">
		<div class="forma_prijava">
			<h2 class="forma_naslov">Prijava</h2>
			<form novalidate id="prijavaForma" class="input_forma" method="get" action="{$smarty.server.PHP_SELF}">
				<input id="korime" name="korime" type="text" class="input-field" placeholder="Korisnicko ime" required value={$korime}>
				<div id="lozinkaPrikazi" style="display:flex; margin-top: 5px; flex-direction:row; border-bottom:solid 1px #999; height:40px">
				<input id="lozinka" style="border:none" name="lozinka" type="password" class="input-field" placeholder="Lozinka" required value={$lozinka}>
                <p id="prikazi" style="cursor:pointer; height: 20px; margin:auto; color:gray; border:none; background:none">Prikazi</p>
				</div>
				
				<div class="zaboravljenaLozinka"><a href="{$putanja}/obrasci/zaboravljenaLozinka.php">Zaboravljena lozinka</a></div>
                <input type="checkbox" class="check-box"><span class="spremiLozinku">Zapamti prijavu</span>
				<button type="submit" name="submit" value="Prijavi se" class="submit-btn">Prijavi me</button>
			</form>

		</div>
		<script>
			
		</script>
	</main>
 