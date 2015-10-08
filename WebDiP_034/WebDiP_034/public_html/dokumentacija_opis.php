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
        <title>navigacijski dijagrami</title>
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

            <section id="zadatak">
                Projektni zadatak (preuzeto: Web DiP, FOI):
                <br>
                <p>
                Sustav omogućuje upravljanje verzijama dokumenata na njemu te omogućuje on-line
                editiranje dokumenata. Svi dokumenti su kategorizirani prema definiranim kategorijama (npr.
                prema ekstenziji dokumenata, namjeni dokumenata itd.)
                Korisnici sustava su:
                Neregistrirani korisnik može samo vidjeti kategorije, broj dokumenata po kategoriji te
                korisnike koji rade na pojedinoj kategoriji.
                Registrirani korisnik može postavljati dokumente na sustav, definirati njihovu pripadnost
                jednoj ili više kategorija, kreirati direktorije u kategoriji za koju ima prava na to te komentirati i
                ocjenjivati dokumente koji su mu vidljivi i za koje su uključeni komentari. Svaki dokument ima
                sliku koja je ili slika kategorije u kojoj se nalazi ili slika samog dokumenta. Verzije
                dokumenata se definiraju prilikom svake predaje nove verzije već postojećeg dokumenta.
                Verzioniranje se definira ili automatski (npr. timestamp uploada) ili ručno unešenim nazivom
                dokumenta. Sustav omogućuje pregled svih verzija dokumenata kroz vrijeme sa podacima o
                autoru izmjene, vremenu izmjene, komentarima uz pojedinu verziju itd. Dokument je moguće
                postaviti tako da mu je pristup moguć tek nakon plaćanja (simulirano) - korisnici onda mogu
                dodati dokumente u košaricu i nakon potvrde plaćanja su im dostupni. Korisnik je automatski
                pretplaćen na e-mail poruke sa izmjenama dokumenata koje je postavio u sustav i može se
                pretplatiti da dobije mail sa izmjenama nekih njemu bitnih dokumenata (npr. raspored).
                Voditelj kategorije ima sva prava registriranih korisnika te uz to uređuje kategoriju (npr.
                definira ekstenzije koje su dozvoljene), uređuje prava registriranih korisnika nad kategorijom i
                pojedinim dokumentima (čitanje, pisanje, komentiranje postavljenih dokumenata. Ima prava
                zabrane korisnika od pristupa ili setu dokumenata ili cijeloj kategoriji.
                Administrator ima sva prava voditelja kategorije te uz to uređuje korisnike, kreira kategorije
                te definira voditelje kategorija. Da bi netko postao voditelj kategorije mora biti registrirani
                korisnik i poslati zahtjev za vođenje kategorije. Može vidjeti statistike sustava - korisnike
                prema aktivnosti (broj komentara, broj postavljenih dokumenta), kategorije prema aktivnosti,
                dokumente prema aktivnosti.
                </p>
            </section>

            <section id="rjesenje">
                <br>
                <br>
                Projektno rješenje:
                <br>
                <p>
                Da bih upoznao domenu za koju ću morati napraviti sustav, a kako bi taj sustav bio što bolji,
                upoznao sam se sa poznatim postojećim rješenjima (Google Docs i ostali). Nakon toga sam počeo 
                modelirati sustav počevši od ERA modela koji sam radio po korisničkim zahtjevima. Nakon toga je slijedila
                izrada ostalih dijagama (USE CASE) te implementacija ERA modela u funkcionalnu bazu podataka.
                Nakon toga sam mogao početi raditi na samom web dizajnu i programiranju. Krenuo sam od html-a i css-a,
                pritom poštujući stroga pravila validacije. Tako sam postepeno dolazio do JavaScripta (strana klijenta), 
                a na poslijetku i do PHP-a (strana poslužitelja) čime sam dobio dinamiku sustava. I premda nekoliko korisničkih 
                zahtjeva nisam programski realizirao napravio sam podlogu na ERA modelu za eventualno nadograđivanje 
                sustava. Plugin za samu funkcionalnost sustava (uređivanje dokumenata) nisam koristio već sam napravio svoj 
                model uređivanja dokumenata na primjeru .txt datoteka i vođenju evidencije o promjenama dokumenata u bazi podataka.
                Smatram da je ionako mnogo besplatnih pluginova svima dostupno pa se ovaj sustav može lako prilagoditi 
                bilo kojem pluginu. Umjesto pluginu, pažnju sam posvetio sigurnosti i kvaliteti sustava. Pritom sam 
                vodio posebnu brigu o različitim pogledima u sustavu, o osiguranju sustava od automata prilikom 
                registracije i sl. Također, izradio sam mnogo skripti od kojih su neke vezane za CRU operacije nad
                tablicama u bazi podataka, neke za provjeru određenih podataka, a neke za proslijeđivanje i obradu, odnosno 
                prikaz podataka. Kroz cijelo vrijeme razvoja ovog sustava misao vodilja mi je bila jednostavno korištenja i 
                sigurnost sustava za korisnike.
                </p>
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