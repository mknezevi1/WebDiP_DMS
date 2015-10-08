var forma = document.forms[0];
var stari_naziv = "";
var novi_naziv = "";
var greska_naz = 0;

forma.addEventListener('submit', provjera);

$('#naziv').blur(function() {
    nazivi();
}); 

//nazivi verzija dokumenata (ne smiju biti isti da ne dode do prebrisavanja)
function nazivi(e) {
    var stari_naziv = document.getElementById('stari_naziv');
    var novi_naziv = document.getElementById('naziv');
    if (stari_naziv.value === novi_naziv.value) {
        novi_naziv.style.background = 'pink';
        greska_naz = greska_naz + 1;
        if (greska_loz < 2) //pazi da dvaput ne das istu obavijest
        {
            var poruka = 'Ime nove verzije mora biti različito';
            var porukaElement = document.createElement('span');
            porukaElement.innerHTML = poruka;
            porukaElement.className = 'pogreska';
            novi_naziv.parentNode.appendChild(porukaElement);
        }
        novi_naziv.focus(); //daj focus na element lozinka2
        return false;
    }
    else
        return true;
}

function provjera(e) {
    $('.pogreska').remove(); //removaj sve objekte koji imaju klasu .pogreska (da se izbrisu spanovi pogreski)
    for (var i = 0; i < input.length; i++)
        input[i].style.background = 'white';
    if (!(nazivi()))
        e.preventDefault(); //ako bilo koji provjera vrati false (nadena pogreska), sprijeci da se podaci posalju serveru
}

        