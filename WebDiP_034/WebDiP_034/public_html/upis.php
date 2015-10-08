<?php
session_start();

if (!isset($_SESSION['korime'])) {
    header('Location:prijava.php');
    exit();
}

//ispitivanje jel postoji datoteka s istim imenom u folderu /datoteke
$ime_datoteke = $_POST["naziv"] . '.txt'; //ime za provjeru
$handle = opendir('datoteke/');
$postoji = false;
while (false !== ($entry = readdir($handle))) { //entry je ime datoteke iz foldera /datoteke
    if ($entry == $ime_datoteke)
        $postoji = true;
}
closedir($handle);

if ($postoji) {
    $_SESSION['sadrzaj'] = $_POST["sadrzaj"];
    header('Location: uredivanje_datoteka.php?cilj=' . $_POST["naziv"]);
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
        <title>upis datoteke</title>
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
            error_reporting(E_ALL);  //ukljuci obavijesti o pogreskama
            ini_set('display_errors', 'On');

            require_once('baza/korisnici.php'); //fatal error ako se korisnici.php ne uspije uključiti

            $ime_datoteke = $_POST["naziv"] . '.txt';
            $naziv = 'datoteke/' . $ime_datoteke;
            $sadrzaj = $_POST["sadrzaj"];

            //zapis datoteke u folder /datoteke (iznad putanja pridodana nazivu)
            $fp = fopen($naziv, "w+");
            fwrite($fp, $sadrzaj);
            fclose($fp);

            echo "OBAVIJEST: vaš dokument je pohranjen i vidljiv na sustavu";
            $baza = new Baza();

            $naziv = $_POST["naziv"];
            $autor = $_POST["autor"];
            $dokument = $_POST["dokument"];

            $vrijeme = date('Y.m.d H:i:s');

            //evidencija u bazu
            $baza->upisiDatoteku($naziv, $dokument, $autor, $vrijeme);

            $korime = $_SESSION['korime'];
            $errorMessage = $vrijeme . " Unos dokumenta:" . $korime . "\n";
            error_log($errorMessage, 3, "info.log"); //3 : message is appended to the file destination. 
            ?>

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

        <script type="text/javascript" src="js/mknezevi1_min.js" ></script> 
    </body>
</html>