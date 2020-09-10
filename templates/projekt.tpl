<main style="height:15%;margin: auto" class="hero-section">
</main>
<main class="Projekt_Main">
    <div class="projekt_stvari">
        <div class="projekt_naslov">
            <h1>{$podaciProjekt.akronim} - {$podaciProjekt.naziv}</h1>
        </div>
        <div class="projekt_opisi">
            <div class="projekt_opis">
                <h3>Opis:</h3>
                <p style="max-width: 600px">{$podaciProjekt.opis}</p>
            </div>
            <div style="border-left: solid 1px black;" class="projekt_znacajke">
                
                 <p>Početak projekta: {$podaciProjekt.pocetak}</p>
                 <p>Projekt završava: {$podaciProjekt.kraj}</p>
                 {if $podaciProjekt.status == 1  && $podaciProjekt.minimalni_iznos < $podaciProjekt.prikupljeno}
                    <p>Status: <span  style="font-size: 15px;background: green;padding: 10px; border-radius:10px">Izvrseno</span></p>
                     
                     {elseif $podaciProjekt.status == 0 && $podaciProjekt.minimalni_iznos > $podaciProjekt.prikupljeno}
                         <p>Status: <span   style="font-size: 15px;color:#222; background: #FFD700;padding: 10px; border-radius:10px">U tijeku</span></p>
                         {else}
                             <p>Status: <span   style="font-size: 15px;background: red;padding: 10px; border-radius:10px">Isteklo</span></p>
                 {/if}
                 
                 <p>Potreban iznos: {$podaciProjekt.minimalni_iznos} kn</p>
                 <p>Prikupljen iznos: {$podaciProjekt.prikupljeno} kn</p>
            </div>
            
        
        </div>
        <div class="video_projekta">
        <iframe width="560" height="315" style="display:block" src="https://www.youtube.com/embed/DKM453G3oFQ?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" ></iframe>
        <iframe width="560" height="315" style="display:block" src="https://www.youtube.com/embed/j4s8D9hjFQQ?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        {if isset($smarty.session.uloga) && $podaciProjekt.status == 0 && $podaciProjekt.minimalni_iznos > $podaciProjekt.prikupljeno}
            <button style="margin-top:50px"class="submit-btn">Doniraj</button>
        {/if}
        
    </div>
</main>








