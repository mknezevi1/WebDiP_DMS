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
        <title>detalji korisnika</title>
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

            $baza = new Baza();
            $korisnici = $baza->dajKorisnike();

            $broj = count($korisnici);

            $cilj = $_GET['cilj']; //ciljani korisnik po korisnikom imenu
            
            echo 'DETALJI KORISNIKA'; //ciljanog korisnika po korisnikom imenu
            echo "<br>";
            echo "<br>";
            for ($i = 0; $i < $broj; $i++) {
                if ($korisnici[$i]['korime'] === "$cilj") {
                    //echo "<img src=\"../{$korisnici[$i]['slika']}\">";
                    echo "<br>";
                    echo 'korisničko ime:' . $korisnici[$i]['korime'];
                    echo "<br>";
                    echo 'ime:' . $korisnici[$i]['ime'];
                    echo "<br>";
                    echo 'prezime:' . $korisnici[$i]['prezime'];
                    echo "<br>";
                    echo 'grad:' . $korisnici[$i]['grad'];
                    echo "<br>";
                    if (trim($korisnici[$i]['email']) != "")
                        echo 'email:' . $korisnici[$i]['email'];
                }
            }
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

    </body>
</html>
