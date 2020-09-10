<main class="hero-section">
    <div class="korisnici_sekcija">
        <table class="korisnici_tablica">
            <tr style="background: linear-gradient(to right, #ff105f, #BD1220">
                <th style="color:white;">ID</th>
                <th style=" color:white;">Korisničko ime</th>
                <th style="color:white;">email</th>
                <th style="color:white;">Lozinka</th>
                <th style="color:white;">Tip korisnika</th>
                {if isset($smarty.session.uloga) && $smarty.session.uloga === 3 }
                    <th style="color:white;">status</th>
                    <th style="color:white;">Modiranje</th>
                {/if}
            </tr>
            {for $i=0 to $brojRedaka -1 }
                <tr class="tablica_redak">
                    <td class="tablica_stvar">{$idkorisnika[$i]}</td>
                    <td class="tablica_stvar">{$ime[$i]}</td>
                    <td class="tablica_stvar">{$prezime[$i]}</td>
                    <td class="tablica_stvar">{$korime[$i]}</td>
                    <td class="tablica_stvar">{$tipkorisnika[$i]}</td>
                    {if isset($smarty.session.uloga) && $smarty.session.uloga === 3 }
                        <td class="tablica_stvar">
                            <form action="../obrasci/omoguciKorisnika.php" method="post">
                                {if $status[$i] != 1}
                                    <button class="submit-btn" name="omoguci" value="{$idkorisnika[$i]}">Omoguci</button>
                                {else}
                                    <button class="submit-btn" style="width:100%" name="onemoguci" value="{$idkorisnika[$i]}">Onemoguci</button>
                                {/if}
                        </td>
                        </form>
                        <td class="tablica_stvar">
                            <form action="{$putanja}/obrasci/moderirajKorisnika.php" method="post">
                                {if $tipid[$i] == 1}
                                    <button class="submit-btn" name="moderiraj" value="{$idkorisnika[$i]}">Moderiraj</button>
                                {elseif $tipid[$i] == 2}
                                    <button class="submit-btn" style="width:100%" name="odmoderiraj" value="{$idkorisnika[$i]}">Odmoderiraj</button>
                                {else}
                                    <button class="submit-btn" style="width:100%;background: gray" disabled name="admin" value="{$idkorisnika[$i]}">Admin</button>
                                {/if}
                        </td>
                        </form>
                    {/if}
    
    
                </tr>
            {/for}
        </table>
    </div>
</main>