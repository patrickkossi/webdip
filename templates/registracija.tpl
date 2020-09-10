<style>
    #korime{
        border-color: grey;
        {if isset ($slobodnoKorime)}
             {if $slobodnoKorime == 1}
			 
				 border: 1px 	solid;
                 border-color: green;
             {else}
			 
				 border: 1px solid;
                 border-color: red;
             {/if}
        {/if}
    }
    #email{
        border-color: grey;
        {if isset ($slobodanEmail)}
             {if $slobodanEmail == 1}
			 
				 border: 1px solid;
                 border-color: green;
             {else}
			 
				 border: 1px solid;
                 border-color: red;
             {/if}
        {/if}
    }    
</style>
{if !empty($greske)}
    
{foreach from=$greske item=greska}
   {$greska} |
{/foreach}
{/if}
<main class="hero-section">
		<div class="forma_prijava">
			<h2 class="forma_naslov">Registracija</h2>
			<form novalidate id="registracijaForma" class="input_forma_r" method="post" action="{$smarty.server.PHP_SELF}">
			    <input id="korime" name="korime" type="text" class="input-field" placeholder="Korisnicko ime" required  value="{$korime}">
                <input id="ime" name="ime" type="text" class="input-field" placeholder="Ime" required value="{$ime}">
			    <input id="prezime" name="prezime" type="text" class="input-field" placeholder="Prezime" required value="{$prezime}">
				<input id="email" name="email" type="email" class="input-field" placeholder="Email" required value="{$email}">
                <div id="lozinkaPrikazi" style="display:flex; margin-top: 5px; flex-direction:row; border-bottom:solid 1px #999; height:40px">
                <input id="lozinka" style="border:none" name="lozinka" type="password" class="input-field" placeholder="Lozinka" required  value="{$lozinka}">
                <p id="prikazi" style="cursor:pointer; height: 20px; margin:auto; color:gray; border:none; background:none">Prikazi</p>
                </div>
                <div class="g-recaptcha" data-sitekey="6LcR1aIZAAAAANaQiIkqDc2Gpvxubx2yJFx2ZUxc"></div>
				<button id="submit" name="submit" type="submit" class="submit-btn">Registriraj me</button>
			</form>
		</div>
	</main>