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
        <title>uređivanje datoteka</title>  
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
            $datoteke = $baza->dajDatoteke();

            $broj = count($datoteke);

            $cilj = $_GET['cilj'];
            $autor = $_SESSION['id']; 
            $dokument = "";

            //preuzimanje podataka iz bp o datoteci te njenog sadrzaja iz foldera /datoteke
            for ($i = 0; $i < $broj; $i++) {
                if ($datoteke[$i]['naziv'] === "$cilj") {
                    $dokument = $datoteke[$i]['dokument'];
                    $stari_naziv = $datoteke[$i]['naziv'];
                    $dat = 'datoteke/' . $cilj . '.txt';
                    $fp = fopen($dat, "r");
                    $contents = fread($fp, filesize($dat));
                    fclose($fp);
                }
            }
            ?>

            <form id="form1" method="post" name="form1" action="upis.php">
                <?php
                    if(isset($_SESSION['sadrzaj'])){
                        echo 'Molimo izaberite drugi naziv, ovaj je već zauzet <br>';
                        $contents = $_SESSION['sadrzaj'];
                        unset($_SESSION['sadrzaj']);
                    }
                ?>
                <table>   
                    <tr>
                        <td><label id="autorl" for="autor">autor id</label></td>
                        <td><input id="autor" name="autor" type="text" readonly value="<?php echo $autor; ?>"></td>
                    </tr>
                    
                    <tr>
                        <td><label id="stari_nazivl" for="stari_naziv">verzija</label></td>
                        <td><input id="stari_naziv" name="stari_naziv" type="text" readonly value="<?php echo $stari_naziv; ?>"></td>
                    </tr>
                    
                    <tr>
                        <td><label id="dokumentl" for="dokument">dokument id</label></td>
                        <td><input id="dokument" name="dokument" type="text" readonly value="<?php echo $dokument; ?>"></td>
                    </tr>
                    
                    <tr>
                        <td><label id="nazivl" for="naziv">naziv</label></td>
                        <td><input id="naziv" required="required"  name="naziv" autofocus="autofocus" type="text"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="image" src = "slike/save.png" alt = "spremi" width="64" height="64"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label id="sadrzajl" for="sadrzaj"></label></td>
                        <td>
                            <br>
                            <textarea id="sadrzaj" required="required" name="sadrzaj" rows="30" cols="100" maxlength="1000"><?php echo $contents; ?></textarea>
                            <br>
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
        <script type="text/javascript" src="js/nazivi.js" ></script>
    </body>
</html>