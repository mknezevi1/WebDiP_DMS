<?php
session_start();

if (!isset($_SESSION['korime'])) {
    header('Location:prijava.php');
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
        <title>ispis korisnika</title>
        <link rel="stylesheet" href="css/mknezevi1.css"/>
        <link rel="stylesheet" href="css/zaprint.css" media="print"/>
        <link rel="stylesheet" href="css/jquery.dataTables.css"/>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
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
                            <?php
                            if ($_SESSION['tip'] === '3') {
                                echo '<a href="dokumentacija.php">dokumentacija</a>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if ($_SESSION['tip'] === '3') {
                                echo '<a href="statistika.php">statistika</a>';
                            }
                            ?>
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
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');

            require_once('baza/korisnici.php'); //fatal error ako se korisnici.php ne uspije uključiti

            $baza = new Baza();
            $korisnici = $baza->dajKorisnike();

            require_once('recaptchalib.php'); // ukljuci biblioteku recaptchalib

            //varijabli data slika (string)
            $uredivanje = '<img src = "slike/uredivanje.png" alt = "uredivanje" width="40" height="40"/>';
            $detalji = '<img src = "slike/detalji.png" alt = "detalji" width="40" height="40"/>';
            $prava = '<img src = "slike/prava.png" alt = "prava" width="40" height="40"/>';

            echo "<table id='tablica'>";
            if ($_SESSION['tip'] === '3')
                echo "<thead><tr><th>korisničko ime</th><th>ime</th><th>prezime</th><th>detalji</th><th>uređivanje</th><th>uređivanje prava</th></tr></thead>";
            else
                echo "<thead><tr><th>korisničko ime</th><th>ime</th><th>prezime</th><th>detalji</th><th>uređivanje</th><th></th></tr></thead>";
            echo "<tbody>";
            foreach ($korisnici as $korisnik) {
                echo "<tr>";
                echo "<td>" . $korisnik['korime'] . "</td>";
                echo "<td>" . $korisnik['ime'] . "</td>";
                echo "<td>" . $korisnik['prezime'] . "</td>";
                echo "<td><a href='detalji_jednog_mojih.php?cilj=" . $korisnik['korime'] . "'>$detalji</a></td>";
                if ($_SESSION['tip'] === '3' || $_SESSION['korime'] === $korisnik['korime'])
                    echo "<td><a href='uredivanje_mojih.php?cilj=" . $korisnik['korime'] . "'>$uredivanje</a></td>";
                else
                    echo "<td></td>";
                if ($_SESSION['tip'] === '3')
                    echo "<td><a href='uredivanje_prava.php?cilj=" . $korisnik['korime'] . "'>$prava</a></td>";
                else
                    echo "<td></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>
            <script>$('#tablica').dataTable();</script>
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
