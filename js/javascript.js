if (document.getElementById('prijavaForma') === null){
   
   document.cookie = "location="+window.location.href+";path=/";  
}
//registracija
if (document.getElementById('registracijaForma') !== null) {
   gumbSubmit = document.getElementById('submit');
   //gumbSubmit.setAttribute("disabled", "disabled");

   //provjera da ime sadržava samo alfabetske znakove
   document.getElementById('ime').addEventListener("keyup", (e) => {
      ime = document.getElementById('ime');
      let re = new RegExp('^([a-ž]|[A-Ž])*$');
      if (ime.value !== "") {
         re = re.test(ime.value);
      }
      if (!re === true) {
         ime.style.backgroundColor = '#ffcccb';
         ime.setAttribute('title', 'Ime se smije sastojati samo od alfabetskih znakova');
      } else if (re === true) {
         ime.style.backgroundColor = '#d2e9af';
         ime.setAttribute('title', 'Ime je točno uneseno');
      } else {
         ime.setAttribute('title', 'Ime ne smije biti prazno');
         ime.style.backgroundColor = '#ffcccb';
      }
   });
   //provjera da prezime sadržava samo alfabetske znakove
   document.getElementById('prezime').addEventListener("keyup", (e) => {
      prezime = document.getElementById('prezime');
      let re = new RegExp('^([a-ž]|[A-Ž])*$');
      if (prezime.value !== "") {
         re = re.test(prezime.value);
      }
      if (!re === true) {
         prezime.style.backgroundColor = '#ffcccb';
         prezime.setAttribute('title', 'Prezime se smije sastojati samo od alfabetskih znakova');
      } else if (re === true) {
         prezime.style.backgroundColor = '#d2e9af';
         prezime.setAttribute('title', 'Prezime je točno uneseno');
      } else {
         prezime.setAttribute('title', 'Polje prezime ne smije biti prazno');
         prezime.style.backgroundColor = '#ffcccb';
      }
   });
   document.getElementById('korime').addEventListener("keyup", (e) => {
      korime = document.getElementById('korime');
      let re = new RegExp('^([a-z]|[A-Z]|_|[0-9])*$');
      if (korime.value !== "") {
         re = re.test(korime.value);
      }
      if (!re === true) {
         korime.style.backgroundColor = '#ffcccb';
         korime.setAttribute('title', 'Korisnicko ime se smije sastojati samo od alfanumerickih znakova i znaka _');
      } else if (re === true) {
         korime.style.backgroundColor = '#d2e9af';
         korime.setAttribute('title', 'Korisnicko ime je točno uneseno');
      } else {
         korime.setAttribute('title', 'Polje prezime ne smije biti prazno');
         korime.style.backgroundColor = '#ffcccb';
      }
   });
   //provjera da je email tocnog formata sadržava samo alfabetske znakove
   document.getElementById('email').addEventListener("keyup", (e) => {
      email = document.getElementById('email');
      let re = /^[a-z]+@[a-z]+\.[a-z]+$/;
      if (email.value !== "") {
         re = re.test(email.value);
      }
      if (!re === true) {
         email.style.backgroundColor = '#ffcccb';
         email.setAttribute('title', 'Email mora biti oblika "nesto@nesto.nesto"');
      } else if (re === true) {
         email.style.backgroundColor = '#d2e9af';
         email.setAttribute('title', 'email je točno unesen');
      } else {
         email.setAttribute('title', 'Polje email ne smije biti prazno');
         email.style.backgroundColor = '#ffcccb';
      }
   });

   //provjeri dali lozinka ima 8 znakova jedno slovo i jedan broj
   document.getElementById('lozinka').addEventListener("keyup", (e) => {
      lozinka = document.getElementById('lozinka');
      lozinkaPrikazi = document.getElementById('lozinkaPrikazi');
      let re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      if (lozinka.value !== "") {
         re = re.test(lozinka.value);
      }
      if (!re === true) {
         lozinkaPrikazi.style.backgroundColor = '#ffcccb';
         lozinkaPrikazi.setAttribute('title', 'Lozinka mora sadrzavati 8 znakova i makar jedno slovo i jedan broj"');
      } else if (re === true) {
         lozinkaPrikazi.style.backgroundColor = '#d2e9af';
         lozinkaPrikazi.setAttribute('title', 'lozinka je točno unesena');
      } else {
         lozinkaPrikazi.setAttribute('title', 'Polje lozinka ne smije biti prazno');
         lozinkaPrikazi.style.backgroundColor = '#ffcccb';
      }
   });

   // prikazi i sakrij lozinku
   document.getElementById('prikazi').addEventListener('click', () => {
      if (document.getElementById('lozinka').type === "password") {

         document.getElementById('lozinka').type = "text";
         document.getElementById('prikazi').innerHTML = "Sakri";
      } else {
         document.getElementById('lozinka').type = "password";
         document.getElementById('prikazi').innerHTML = "Prikazi";
      }
   });

}

//kolacic za uvjete koristenja
if (localStorage.getItem('Uvjeti') != 'prihvaceno') {
   $('.cookie-banner').delay(2000).fadeIn();

};
$('#zatvoriUvjete').click(function () {
   $('.cookie-banner').fadeOut();
   localStorage.setItem('Uvjeti', 'prihvaceno');
})

if (document.getElementById('profil') !== null) {
   lozinka = document.getElementById('lozinka');
   ponlozinka = document.getElementById('lozinka_ponovo');
   if(lozinka.value === ponlozinka.value) console.log("Hey");
   ponlozinka.addEventListener("keyup", (e) => {
      console.log("hey");
      if(lozinka.value === ponlozinka.value){
         lozinka.style.border = "solid green";
         ponlozinka.style.border = "solid green";
         document.getElementById('submit').removeAttribute("disabled");
         document.getElementById('submit').removeAttribute("style");
         
      }else{
         lozinka.style.border = "solid red";
         ponlozinka.style.border = "solid red";
         document.getElementById('submit').setAttribute("disabled", "disabled");
         document.getElementById('submit').setAttribute("style" , "background: linear-gradient(to right, #222, #777);");

      }
   });
   lozinka.addEventListener("keyup", (e) => {
      console.log("hey");
      if(lozinka.value === ponlozinka.value){
         lozinka.style.border = "solid green";
         ponlozinka.style.border = "solid green";
         document.getElementById('submit').removeAttribute("disabled");
         document.getElementById('submit').removeAttribute("style");

      }else{
         lozinka.style.border = "solid red";
         ponlozinka.style.border = "solid red";
         document.getElementById('submit').setAttribute("disabled", "disabled");
         document.getElementById('submit').setAttribute("style" , "background: linear-gradient(to right, #222, #777);");
      }
   });

}
document.getElementById('prikazi').addEventListener('click', () => {
   console.log("hej");

   if (document.getElementById('lozinka').type === "password") {

      document.getElementById('lozinka').type = "text";
      document.getElementById('prikazi').innerHTML = "Sakri";
   } else {
      document.getElementById('lozinka').type = "password";
      document.getElementById('prikazi').innerHTML = "Prikazi";
   }
});
document.getElementById('prikazipon').addEventListener('click', () => {
   console.log("hej");
   if (document.getElementById('lozinka_ponovo').type === "password") {

      document.getElementById('lozinka_ponovo').type = "text";
      document.getElementById('prikazipon').innerHTML = "Sakri";
   } else {
      document.getElementById('lozinka_ponovo').type = "password";
      document.getElementById('prikazipon').innerHTML = "Prikazi";
   }
});