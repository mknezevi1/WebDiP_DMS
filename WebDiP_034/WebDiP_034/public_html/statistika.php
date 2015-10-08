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
        <title>statistika</title>
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
            <?php
            error_reporting(E_ALL);  //ukljuci obavijesti o pogreskama
            ini_set('display_errors', 'On');
            ?>

            <section>
                <?php
                require_once('baza/korisnici.php'); //fatal error ako se korisnici.php ne uspije uključiti

                $baza = new Baza();
                $polje = $baza->dajStatistiku();

//fillRect() metoda crta puni pravokutnik
//strokeRect() metoda crta prazni pravokutnik (okvir dijagrama)
//fillStyle je boja stupca/teksta
                ?>

                <canvas id="prikaz" width="600" height="400"></canvas>
                <script type="text/javascript">
                    var prikaz = document.getElementById("prikaz");
                    var ctx = prikaz.getContext("2d");
                    ctx.fillStyle = "rgb(0, 0, 0)";
                    ctx.strokeRect(40, 0, 320, 400);

                    ctx.fillStyle = "rgb(0,0,255)";
                    ctx.fillRect(100 + 40 * (0 - 1), 400 - <?php echo $polje[0] * 10; ?>, 38, 400); //prvi stupac (0-1)

                    ctx.fillStyle = "rgb(255,255,0)";
                    ctx.fillRect(100 + 40 * (1 - 1), 400 - <?php echo $polje[1] * 10; ?>, 38, 400); //drugi stupac (1-1)

                    ctx.fillStyle = "rgb(255,0,0)";
                    ctx.fillRect(100 + 40 * (2 - 1), 400 - <?php echo $polje[2] * 10; ?>, 38, 400); //treci stupac (2-1)
                </script>
                <br>
                Kazalo dijagrama
                <p>
                    <span style="color:rgb(0,0,255)">broj korisnika: <?php echo $polje[0]; ?><br></span>
                    <span style="color:rgb(255,255,0)">broj dokumenata: <?php echo $polje[1]; ?><br></span>
                    <span style="color:rgb(255,0,0)">broj verzija dokumenata: <?php echo $polje[2]; ?><br></span>        
                </p>

                <br>
                Ostale informacije
                <p>
                    <span style="color:rgb(0,0,255)">prosječan broj verzija dokumenata po korisniku: <?php echo ($polje[2] / $polje[0]); ?><br></span>
                    <span style="color:rgb(0,0,255)">prosječan broj verzija po dokumentu: <?php echo ($polje[2] / $polje[1]); ?><br></span>
                    <span style="color:rgb(0,0,255)">prosječan broj dokumenata po korisniku: <?php echo ($polje[1] / $polje[0]); ?><br></span>        
                </p>
            </section>

            <br>
            <br>
            <a href="ispis_log.php">Log sustava</a>

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