<?php
session_start();

if (!isset($_SESSION['korime']))
{
    header('Location:prijava.php');
    exit();
}
else if ($_SESSION['tip'] !== '3') {
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
        <title>uređivanje prava</title>  
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.ui.min.js"></script>

        <script type="text/javascript" src="js/gradovi.js"></script>

        <link rel="stylesheet" href="css/mknezevi1.css"/> 
        <link rel="stylesheet" href="css/zaprint.css" media="print"/>
        <link href="css/jquery-ui-1.10.2.custom.css" rel="stylesheet"/>
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

            require_once('baza/korisnici.php'); //fatal error ako se korisnici.php ne uspije uključiti

            $baza = new Baza();
            $korisnici = $baza->dajKorisnike();

            $broj = count($korisnici);

            $cilj = $_GET['cilj'];

            $id = "";
            $prava = "";
            $tip = "";
            $nopomena = "";
            
            //dohvacanje korisnikovih trenutnih podataka
            for ($i = 0; $i < $broj; $i++) {
                if ($korisnici[$i]['korime'] === "$cilj") {
                    $id = $korisnici[$i]['id'];
                    $prava = $korisnici[$i]['prava'];
                    $tip = $korisnici[$i]['tip'];
                    $nopomena = $korisnici[$i]['nopomena'];
                }
            }

            //ispis trenutnih podataka
            if ($prava === '1')
                echo 'prava: ima';
            else if ($prava === '0')
                echo 'prava: blokiran';
            echo '<br>';
            if ($tip === '1')
                echo 'tip: obični korisnik';
            else if ($tip === '2')
                echo 'tip: voditelj kategorije';
            else if ($tip === '3')
                echo 'tip: administrator';
            ?>

            <form id="formaregistracija" method="post" action="admin.php">
                <table>
                    <tr>
                        <td><input id="id" name="id" type="text" readonly value="<?php echo $id; ?>"></td>
                    </tr>

                    <tr>
                        <td><label id="praval" for="prava">Prava</label></td>
                        <td>
                            <select id="prava" name="prava">
                                <option value="1">
                                    ima
                                </option>
                                <option value="0">
                                    nema
                                </option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label id="tipl" for="tip">Tip</label></td>
                        <td>
                            <select id="tip" name="tip">
                                <option value="1">
                                    obični korisnik
                                </option>
                                <option value="2">
                                    voditelj kategorije
                                </option>
                                <option value="3">
                                    administrator
                                </option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label id="nopomenal" for="nopomena">Pošalji opomenu</label></td>
                        <td><input id="nopomena" name="nopomena" type="checkbox"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit"/>
                        </td>
                    </tr>  
                </table>
            </form>

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

        <script type="text/javascript" src="js/mknezevi1.js" ></script>
    </body>
</html>