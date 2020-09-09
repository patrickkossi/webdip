
// Dohvaćanje korisničkog imena unutar registracije
$('document').ready(function () {
  if ($('#registracijaForma').length) {
    $('#korime').change(function () {
      var korime = $(this).val();
      $.ajax({
        url: "../obrasci/provjerakorimena.php",
        method: "POST",
        data: { korime: korime },
        dataType: "text",
        success: function (data) {
          var $response = $(data);
          $('#korime').css('border', 'solid 2px');
          var subval = $response.filter('#boja').text();
          $('#korime').css('border-color', subval);
          console.log(data);
        }
      });
    });
  }
});
$(document).ready(function () {
  if ($("#kategorijeModeratori").length) {
    console.log("kaje");
    $.ajax({
      url: "../skripte/dohvatiModeratoreKategorija.php",
      type: "GET",
      dataType: "text",
      success: function (data) {
        $('#kategorijeModeratori').append(data);

      }
    });
  }
});

/// Dohvaćanje projekata

function ucitavanjeProjekta(strana = 1) {
  var broj = strana % 2 + 1;
  broj = broj.toString();
  document.getElementById("gumb" + broj).classList.remove("selektiran_gumb");

  $.ajax({
    url: "skripte/ucitajProjekte.php",
    method: "POST",
    data: { osvjezi: 'osvjezi', stranica: strana },
    dataType: "text",
    success: function (data) {
      $('#projekti').html(data);
    }
  });
}
function ucitavanjeVlastitihProjekata(){
  $.ajax({
    url: "../skripte/ucitajMojeProjekte.php",
    method: "POST",
    data: { osvjezi: 'osvjezi'},
    dataType: "text",
    success: function (data) {
      $('#moji_projekti').html(data);
    }
  });
}
$(document).ready(function () {

  if ($('#moji_projekti').length) {
    setTimeout(
      ucitavanjeVlastitihProjekata(),500
    )
    
  }
});
function dodajKompetenciju(){
  var dodaj = $( "#kompetencije_popis option:selected" ).text();
  console.log(dodaj);
  $.ajax({
    url: '../skripte/dohvatiKompetencije.php',
    type: 'POST',
    data: { dodaj: dodaj},
    dataType: "text",
    success: function (data) {
        console.log(data);
        dohvatiKompetencije();
    }
  });
}
function dohvatiKompetencije(){
  console.log("kaje")
  $.ajax({
    url: '../skripte/dohvatiKompetencije.php',
    type: 'GET',
    data: { dohvati: 'dohvati'},
    dataType: "text",
    success: function (data) {
      console.log(data);
      var data = $.parseJSON(data);
      $('#kompetencije_popis').html('')
      $.each(data, function (index, value) {
        
        $('#kompetencije_popis').append('<option style="color: black" value=' + value.kompetencije_id + '>' + value.naziv + '</option>');

      })
    }
  });
  $.ajax({
    url: '../skripte/dohvatiKompetencije.php',
    type: 'GET',
    data: { skupi: 'dohvati'},
    dataType: "text",
    success: function (data) {
      console.log(data);
      var data = $.parseJSON(data);
      $('#moje_kompetencije').html('')

      $.each(data, function (index, value) {
        $('#moje_kompetencije').append('<div style="display:flex; align-items: center; justify-content: center"><p style="color: black; text-align: center">' + value.naziv + '</p><a onclick="maknikompetenciju(' + value.korisnik_kompetencija + ')" style="cursor: pointer;height: 30px;width:30px;padding:10px;margin: 5px;background-color: #ff6666;border-radius: 25px; display: flex; align-items: center; justify-content: center"><span style="font-size: 25px; color: black;">-</span></a></div>');

      })
    }
  });
}
function maknikompetenciju(id){
  $.ajax({
    url: '../skripte/dohvatiKompetencije.php',
    type: 'POST',
    data: { id: id},
    dataType: "text",
    success: function (data) {
      

      dohvatiKompetencije();
    }
  });
}
$(document).ready(function(){
  if($('#popis_kompetencija').length){
    console.log("dobro sta")
    dohvatiKompetencije()
  }
})
function ucitavanjeKorisnika() {

  $.ajax({
    url: "../skripte/dohvatiKorisnike.php",
    method: "GET",
    data: { osvjezi: 'osvjezi' },
    dataType: "text",
    success: function (data) {
      $('#korisnici_tablica').html(data);
      console.log("evo");
    }
  });
}
ucitavanjeKorisnika()
//dohvaćanje kategorija
$(document).ready(function () {

  if ($('#popis_projekata').length) {

    ucitavanjeProjekta();

    console.log("Dohvaćanje kategorija");
    $.ajax({
      url: 'skripte/dohvatiKategorije.php',
      type: 'GET',
      data: { dohvati: 'dohvati' },
      dataType: "text",
      success: function (data) {
        console.log(data);
        var data = $.parseJSON(data);
        $.each(data, function (index, value) {
          $('#kategorija_projekta').append('<option value=' + index + '>' + value + '</option>');

        })
      }
    });

    $('#pretraga').keyup(function () {
      var pretraga = $('#pretraga').val();
      console.log(pretraga);
      $.ajax({
        type: "get",
        url: "skripte/filtrirajProjekte.php",
        data: { pretraga: pretraga },
        dataType: "text",
        success: function (data) {
          $('#projekti').html(data);
        }
      });
    });
    $('#kategorija_projekta').change(function () {
      var selected = $(this).children("option:selected").text();
      console.log(selected);
      $.ajax({
        type: "get",
        url: "skripte/filtrirajProjekte.php",
        data: { kategorija: selected },
        dataType: "text",
        success: function (data) {
          $('#projekti').html(data);
        }
      });
    });
  }

});

function dohvacanjeDnevnika(pretraga) {
  $.ajax({
    url: '../skripte/dohvatiDnevnik.php',
    type: 'get',
    data: { dohvati: 'dohvati', pretraga: pretraga },
    dataType: "text",
    success: function (data) {
      $('#dnevnik').html('');
      
      if(data.length === 2){
        console.log("ha")
        var stuff= "<h1 style='color: black'>Nema podataka od tog datuma</h1>"
      }else{
        var data = $.parseJSON(data);
      $('#dnevnik').html('');
      var stuff = '<div class="gridDnevnik"><span class="grid_header"><strong>Datum</strong></span><span class="grid_header"><strong>Lokacija</strong></span><span class="grid_header"><strong>Dogadaj</strong></span><span class="grid_header"><strong>Obrisi</strong></span>'
      $.each(data, function (index, value) {
        stuff += '<span>' + value.Vrijeme + '</span><span>' + value.Lokacija + '</span><span >' + value.Dogadaj + '</span><span><button class="submit-btn manji" style="background: red ;color: white;" onclick="deleteDnevnikEntry('+ value.id+')">X</button></span>';
      })
      stuff += '</div>';
      }
      $('#dnevnik').append(stuff);

      

    }
  });
}

function deleteDnevnikEntry(id){
  $.ajax({
    url: '../skripte/dohvatiDnevnik.php',
    type: 'post',
    data: { id: id},
    dataType: "text",
    success: function (data) {
      dohvacanjeDnevnika('');
    }
    });
  
}
$(document).ready(function () {
  if ($('#dnevnik').length) {
    dohvacanjeDnevnika('');
    console.log("dnevnik");
  }
  $('#pretraga').keyup(function(){
    dohvacanjeDnevnika(document.getElementById("pretraga").value  );
  })

})