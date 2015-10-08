<?php
session_start();
require_once('baza/korisnici.php');
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
        <title>Matija Knežević početna</title>
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
                            <a href="registracija.php">registracija</a>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['korime'])) {
                                echo ' <a href="ispis_datoteka.php">dokumenti</a>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['korime'])) {
                                echo '<a href="ispis_mojih.php">korisnici</a>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['tip']))
                                if ($_SESSION['tip'] === '3') {
                                    echo '<a href="dokumentacija.php">dokumentacija</a>';
                                }
                            ?>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['tip']))
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
            <section>
                <div id="prijavi" hidden="hidden">
                    <form id="formaprijava" method="post" action="http://arka.foi.hr/WebDiP/2012/vjezba_02/ispis_forme.php">
                        <table>
                            <tr>
                                <td><label id="korimel" for="korime">Korisničko ime</label></td>
                                <td><input id="korime" required="required" pattern=".{6,}" name="korime" placeholder="korisničko ime" autofocus="autofocus"></td>
                            </tr>

                            <tr>
                                <td><label id="lozinkal" for="lozinka">Lozinka</label></td>
                                <td><input id="lozinka" required="required" pattern=".{6,}" name="lozinka" placeholder="lozinka" type="password"></td>
                            </tr>

                            <tr>
                                <td><label id="zapamtil" for="zapamti">Zapamti me</label></td>
                                <td><input id="zapamti" name="zapamti" type="checkbox"></td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="submit"/>
                                </td>
                            </tr>  
                        </table>
                    </form>
                </div>
            </section>

            <section id="glavni_sadrzaj">
                <section id="osnovno">
                    <br>
                    <p>
                    Besplatno iskusite pogodnosti našeg sustava!
                    </p>
                </section>

                <section id="skice">
                    <br>
                    <img src = "slike/ss.png" alt = "slika sustava" width="800" height="400"/>
                </section>
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

        <script type="text/javascript" src="js/mknezevi1_min.js" ></script> 
    </body>
</html>

