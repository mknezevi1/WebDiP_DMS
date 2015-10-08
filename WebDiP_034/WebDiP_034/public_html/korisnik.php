<?php

header("Content-Type:application/xml");
echo '<?xml version="1.0" encoding="utf-8"?><korisnici>';

require_once('baza/korisnici.php');

//prihvaceno ime za provjeru
$korisnik = $_GET['korisnik'];

$baza = new Baza();
$korisnici = $baza->ispitajKorisnike($korisnik);
//ako je vraceno polje prazno, nema korisnika sa tim korisnickim imenom i vrati rezultat 0
if(empty($korisnici))
        echo "<korisnik>0</korisnik>";
else
        echo "<korisnik>1</korisnik>";

echo "</korisnici>";
?>