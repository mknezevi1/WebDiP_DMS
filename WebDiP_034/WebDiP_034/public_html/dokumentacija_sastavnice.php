<?php
session_start();

if (!isset($_SESSION['korime'])) {
    header('Location:prijava.php');
    exit();
} else if ($_SESSION['tip'] !== '3') {
    header('Location:ispis_mojih.php');
    exit();
}
?>

<?php
if (isset($_GET['odjava'])) {
    unset($_SESSION['korime']);
    session_destroy();
    header('Location:prijava.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>opis projekta</title>
        <link rel="stylesheet" href="css/mknezevi1.css"/>
        <link rel="stylesheet" href="css/zaprint.css" media="print"/>
    </head>
    <body>

        <div id="staticko">
            <section id="zagljavlje">
                <img src = "slike/mk1.png" alt = "MatijaKnezevic_slika" width="1214" height="295"/>
            </section>

            <section id="glavni_izbornik">
                <nav id="nav1">
                    <ul>
                        <li>
                            <a href="index.php">početna</a>
                        </li>
                        <li>
                            <a href="ispis_datoteka.php">dokumenti</a>
                        </li>
                        <li>
                            <a href="ispis_mojih.php">korisnici</a>
                        </li>
                        <li>
                            <a href="dokumentacija.php">dokumentacija</a>
                        </li>
                        <li>
                            <a href="statistika.php">statistika</a>
                        </li>
                        <li>
                            <?php
//ako imam prijavljenog korisnika nudim mogucnost odjave, ako je neprijavljen ima link za login
                            if (isset($_SESSION['korime'])) {
                                //echo "Prijavljeni korisnik: " . $_SESSION['korime'];
                                echo ' <a href="prijava.php?odjava=1">odjava</a>';
                            } else {
                                echo '<a href="prijava.php">prijava</a>';
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>    

        <div id="dinamicko">  
            Dokumentacija:
            <section>
                <ul>
                    <li>
                        <a href="dokumentacija_opis.php">opis</a>
                    </li>
                    <li>
                        <a href="dokumentacija_era.php">ERA</a>
                    </li>
                    <li>
                        <a href="dokumentacija_use_case.php">USE CASE</a>
                    </li>
                    <li>
                        <a href="dokumentacija_sastavnice.php">sastavnice rješenja</a>
                    </li>
                </ul>
            </section>
            
            <section id="sastavnice">
                folder datoteke (verzije dokumenata korisnika)
                <br>
                folder dijagrami (dijagrami iz dokumentacije)
                <br>
                folder slike (slike sa stranice)
                <br>
                folder css
                <br>
                <ul>
                    <dt>images</dt>
                    <dd>korišteni plugin</dd>
                    <dt>jquery-ui-1.10.2.custom.css</dt>
                    <dd>korišteni plugin</dd>
                    <dt>jquery.dataTables.css</dt>
                    <dd>korišteni plugin</dd>
                    <dt>mknezevi1.css</dt>
                    <dd>primarni css projekta</dd>
                    <dt>mknezevi1_2.css</dt>
                    <dd>sekundarni (zamjenski) css projekta</dd>
                    <dt>zaprint.css</dt>
                    <dd>css projekta za drugi medij (printer)</dd>
                </ul>
                folder js (JavaScript datoteke)
                <br>
                <ul>
                    <dt>gradovi.js</dt>
                    <dd>koristi se za autocomplete gradova pri registraciji</dd>
                    <dt>jquery.dataTables.min.js</dt>
                    <dd>korišteni plugin</dd>
                    <dt>jquery.min.js</dt>
                    <dd>korišteni plugin</dd>
                    <dt>jquery.ui.min.js</dt>
                    <dd>korišteni plugin</dd>
                    <dt>mknezevi1</dt>
                    <dd>temeljni js projekta koji sadrži gotovo sve js funkcije projekta</dd>
                    <dt>mknezevi1_min.js</dt>
                    <dd>js projekta sa samo dijelom funkcionalnosti</dd>
                    <dt>nazivi.js</dt>
                    <dd>js koji sprečava zapis nove verzije dokumenta pod istim nazivom</dd>
                </ul>
                folder podaci
                <br>
                <ul>
                    <dt>gradovi.json</dt>
                    <dd>popis svih gradova RH (preuzeto: Web DiP, FOI)</dd>
                </ul>
                folder baza
                <br>
                <ul>
                    <dt>korisnici.php</dt>
                    <dd>skripta za rad s bazom podataka</dd>
                </ul>
                folder privatno
                <br>
                <ul>
                    <dt>korisnici.php</dt>
                    <dd>privatna skripta za ispis podataka korisnika</dd>
                </ul>
                folder site root
                <ul>
                    <dt>admin.php</dt>
                    <dd>skripta za proslijeđivanje podataka između uređivanja (prava i uloga) i baza/korisnici.php</dd>
                    <dt>detalji_jednog_mojih.php</dt>
                    <dd>prikaz detalja pojedinog korisnika</dd>
                    <dt>dokumentacija.php</dt>
                    <dd>korijen dokumentacijskog dijela sustava</dd>
                    <dt>dokumentacija_era.php</dt>
                    <dd>dokumentacijski dio vezan za ERA model</dd>
                    <dt>dokumentacija_opis.php</dt>
                    <dd>dokumentacijski dio vezan za opis zadatka i opis rješenje</dd>
                    <dt>dokumentacija_sastavnice.php</dt>
                    <dd>dokumentacijski dio vezan za sastavnice rješenja</dd>
                    <dt>dokumentacija_use_case.php</dt>
                    <dd>dokumentacijski dio vezan za USE CASE dijagram</dd>
                    <dt>generiraj_lozinku.php</dt>
                    <dd>skripta za generiranje nove lozinke i obavijest preko emaila</dd>
                    <dt>index.php</dt>
                    <dd>početna stranica sustava</dd>
                    <dt>info.log</dt>
                    <dd>.txt datoteka u koji se zapisuju značajne aktivnosti korisnika na sustavu</dd>
                    <dt>ispis_datoteka.php</dt>
                    <dd>pregled datoteka (verzija dokumenata)</dd>
                    <dt>ispis_mojih.php</dt>
                    <dd>pregled korisnika sustava</dd>
                    <dt>korisnik.php</dt>
                    <dd>skripta za proslijeđivanje podataka pri ispitivanju dostupnosti korisničkog imena između js/mknezevi1.js i baza/korisnici.php</dd>
                    <dt>prijava.php</dt>
                    <dd>početna prijava korisnika u sustav</dd>
                    <dt>provjera.php</dt>
                    <dd>skripta za provjeru podataka pri registraciji/ažuriranju korisnika</dd>
                    <dt>recaptchalib.php</dt>
                    <dd>korišteni plugin</dd>
                    <dt>registracija.php</dt>
                    <dd>registracija korisnika</dd>
                    <dt>statistika.php</dt>
                    <dd>statistika sustava prikazana vizualno(broj korisnika, dokumenata i verzija dokumenata)</dd>
                    <dt>upis.php</dt>
                    <dd>zapis datoteka u /datoteke te proslijeđivanje podataka skripti baza/korisnici</dd>
                    <dt>uredivanje_datoteka.php</dt>
                    <dd>uređivanje nove verzije dokumenta</dd>
                    <dt>uredivanje_dokumenta.php</dt>
                    <dd>uređivanje prve verzije dokumenta (stvaranje dokumenta)</dd>
                    <dt>uredivanje_mojih.php</dt>
                    <dd>uređivanje osobnih podataka korisnika</dd>
                    <dt>uredivanje_prava.php</dt>
                    <dd>uređivanja prava i uloga korisnika</dd>     
                    <dt>zaboravljena.php</dt>
                    <dd>forma za upis emaila kod zaboravljene lozinke</dd>  
                </ul>
            </section>

            <section id="podnozje">
                <br>
                <br>
                <br>
                <br>
                <hr>
                <br>
                autor:
                <br>
                Matija Knežević
                <br>
                Fakultet organizacije i informatike
                <br>
                Sveučilište u Zagrebu
                <br>
                <br>
                kontakt:
                <br>
                mknezevi1@foi.hr
            </section> 
        </div>

    </body>
</html>