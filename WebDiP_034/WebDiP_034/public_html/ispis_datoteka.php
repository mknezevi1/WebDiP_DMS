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
        <title>ispis datoteka</title>
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
            $datoteke = $baza->dajDatoteke();
            
            echo '<a href="uredivanje_dokumenta.php"><img src = "slike/novi.png" alt = "novi dokument" width="128" height="128"/></a>';
            echo '<br>';

            //varijabli data slika (string)
            $uredi = '<img src = "slike/verzija.png" alt = "nova verzija" width="40" height="40"/>';  
            
            echo "<table id='tablica'>";
            echo "<thead><tr><th>autor</th><th>naziv</th><th>vrijeme</th><th></th></tr></thead>";
            echo "<tbody>";
            foreach ($datoteke as $datoteka) {
                echo "<tr>";
                echo "<td>" . $datoteka['korime'] . "</td>";
                echo "<td>" . $datoteka['naziv'] . "</td>";
                echo "<td>" . $datoteka['vrijeme'] . "</td>";
                echo "<td><a href='uredivanje_datoteka.php?cilj=" . $datoteka['naziv'] . "'>$uredi</a></td>";
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
