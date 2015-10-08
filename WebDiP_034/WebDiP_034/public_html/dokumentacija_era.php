<?php
session_start();

if (!isset($_SESSION['korime']))
{
    header('Location:prijava.php');
    exit();
}
else if ($_SESSION['tip'] !== '3')
{
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
        <title>era model</title>
        <link rel="stylesheet" href="css/mknezevi1.css"/>
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
            
            <section id="dijagram">
                <img src = "dijagrami/era.png" alt = "era" width="992" height="722"/>
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