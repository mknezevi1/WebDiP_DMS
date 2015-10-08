var forma = document.forms[0];
var greska_spol = 0;
var greska_loz = 0;
var greska_ime = 0;
var greska_prezime = 0;
var greska_korime = 0;
//greske sprecavaju visestruko ispisivanje pogreski

forma.addEventListener('submit', provjera);

$('#korime').blur(function() {
    dostupnost();
}); //na gubitak fokusa #korime-a pokreni fju dostupnost 

function dostupnost() {
    var provjeri = $('#korime').val(); //u provjeri smjesti vrijednost #korime-a
    var korime = document.getElementById('korime');
    $.ajax({
        url: 'korisnik.php?korisnik=' + provjeri, //skripta s vrijednosti za provjeru
        type: 'GET',
        dataType: 'xml',
        success: function(xml) {
            var data = $(xml).find('korisnici');
            var broj = parseInt(data.text()); //parsiranje vrijednosti u numericku zbod daljneg ispitivanja
            if (broj === 1) {
                $('#korime').effect("highlight", {color: 'pink'}, 3500);
                greska_korime = greska_korime + 1;
                if (greska_korime < 2)
                {
                    var poruka = 'Korisničko ime je zauzeto';
                    var porukaElement = document.createElement('span');
                    porukaElement.innerHTML = poruka;
                    porukaElement.className = 'pogreska';
                    korime.parentNode.appendChild(porukaElement);
                }
            }
            else {
                if (greska_korime > 0)
                    $('span').remove();
            }
        }
    });
}

var input = document.getElementsByTagName("input"); //polje elemenata s tagom input
for (var i = 0; i < input.length; i++) {
    input[i].addEventListener("focus", function() { //svim inputima daj eventlistener na event focus
        this.className = "fokus"; //označi ih ovako
    });
    input[i].addEventListener("blur", function() { //svim inputima na blur(gubitak focusa) 
        this.className = ""; //makni klasu
    });
}

var labela = document.getElementsByTagName("label");
for (var i = 0; i < labela.length; i++) {
    labela[i].addEventListener("mouseover", function() { //misem iznad
        this.className = "hover";
    });
    labela[i].addEventListener("mouseout", function() { //misem se maknut s toga
        this.className = "";
    });
}

function provjera_lozinke(e) {
    var lozinka = document.getElementById('lozinka');
    var lozinka2 = document.getElementById('lozinka2');
    if (lozinka.value !== lozinka2.value) {
        lozinka2.style.background = 'pink';
        greska_loz = greska_loz + 1;
        if (greska_loz < 2) //pazi da dvaput ne das istu obavijest
        {
            var poruka = 'Potvrda lozinke nije identična';
            var porukaElement = document.createElement('span');
            porukaElement.innerHTML = poruka;
            porukaElement.className = 'pogreska';
            lozinka2.parentNode.appendChild(porukaElement);
        }
        lozinka2.focus(); //daj focus na element lozinka2
        return false;
    }
    else
        return true;
}

function provjera_imena(e) {
    var ime = document.getElementById('ime');
    var pattern = /^[A-ZŠĐČĆŽ]{1}[a-zšđčćž]{1,}$/; //1 znak veliko slovo, dalje sve mala slova
    var porukaElement;
    if (!(pattern.test(ime.value))) { //pattern i upisana vrijednost se ne slazu
        ime.style.background = 'pink';
        greska_ime = greska_ime + 1;
        if (greska_ime < 2)
        {
            var poruka = 'Format unosa nije točan';
            porukaElement = document.createElement('span');
            porukaElement.innerHTML = poruka;
            porukaElement.className = 'pogreska';
            ime.parentNode.appendChild(porukaElement);
        }
        ime.focus();
        return false;
    }
    else
        return true;
}

function provjera_prezimena(e) {
    var prezime = document.getElementById('prezime');
    var pattern = /^[A-ZŠĐČĆŽ]{1}[a-zšđčćž]{1,}$/;
    if (!(pattern.test(prezime.value))) {
        prezime.style.background = 'pink';
        greska_prezime = greska_prezime + 1;
        if (greska_prezime < 2)
        {
            var poruka = 'Format unosa nije točan';
            var porukaElement = document.createElement('span');
            porukaElement.innerHTML = poruka;
            porukaElement.className = 'pogreska';
            prezime.parentNode.appendChild(porukaElement);
        }
        prezime.focus();
        return false;
    }
    else
        return true;
}


function provjera(e) {
    $('.pogreska').remove(); //removaj sve objekte koji imaju klasu .pogreska (da se izbrisu spanovi pogreski)
    for (var i = 0; i < input.length; i++)
        input[i].style.background = 'white';
    if (!(provjera_lozinke() && provjera_imena() && provjera_prezimena()))
        e.preventDefault(); //ako bilo koji provjera vrati false (nadena pogreska), sprijeci da se podaci posalju serveru
}

        