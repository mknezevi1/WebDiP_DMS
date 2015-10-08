<?php
session_start();

$vrijeme = date('Y.m.d H:i:s');

if (!isset($_SESSION['korime']))
{
    header('Location:prijava.php');
    exit();
}
else if ($_SESSION['tip'] !== '3' && $_SESSION['korime'] !== $_GET['cilj'])
{
    $errorMessage = $vrijeme . " Pokusaj uredivanje tudih podataka:" . $_SESSION['korime'] . "\n";
    error_log($errorMessage, 3, "info.log"); //3 : message is appended to the file destination.
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
        <title>uređivanje korisnika</title>  
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
            $korisnici = $baza->dajKorisnike();

            $broj = count($korisnici);

            $cilj = $_GET['cilj'];

            $id = "";
            $ime = "";
            $prezime = "";
            $korime = "";
            $email = "";
            
            //preuzimanje korisnikovih trenutnih podataka
            for ($i = 0; $i < $broj; $i++) {
                if ($korisnici[$i]['korime'] === "$cilj") {
                    //echo "<img src=\"../{$korisnici[$i]['slika']}\">";
                    $id = $korisnici[$i]['id'];
                    $korime = $korisnici[$i]['korime'];
                    $ime = $korisnici[$i]['ime'];
                    $prezime = $korisnici[$i]['prezime'];
                    if (trim($korisnici[$i]['email']) != "")
                        $email = $korisnici[$i]['email'];
                    else
                        $email = '';
                }
            }
            require_once('recaptchalib.php'); // ukljuci biblioteku recaptchalib
            ?>

            <form id="formaregistracija" method="post" action="provjera.php">
                <table>
                    <tr>
                        <td><input id="id" name="id" type="text" readonly value="<?php echo $id; ?>"></td>
                    </tr>

                    <tr>
                        <td>
                            <?php
                            require_once('recaptchalib.php');
                            $publickey = "6LcWY-ASAAAAAIWt0gYBMtr9_7SqkdAVlQ5o0JSo"; // you got this from the signup page
                            echo recaptcha_get_html($publickey);
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td><label id="imel" for="ime">Ime</label></td>
                        <td><input id="ime" required="required"  name="ime" placeholder="ime" autofocus="autofocus" type="text" value="<?php echo $ime; ?>"></td>
                    </tr>

                    <tr>
                        <td><label id="prezimel" for="prezime">Prezime</label></td>
                        <td><input id="prezime" required="required" name="prezime" placeholder="prezime" type="text" value="<?php echo $prezime; ?>"></td>
                    </tr>

                    <tr>
                        <td><label id="emaill" for="email">E-mail</label></td>
                        <td><input id="email" required="required" name="email" placeholder="email" type="email" value="<?php echo $email; ?>"></td> 
                    </tr>

                    <tr>
                        <td><label id="korimel" for="korime">Korisničko ime</label></td>
                        <td><input id="korime" required="required" pattern=".{6,}" name="korime" placeholder="korisničko ime" type="text" value="<?php echo $korime; ?>"></td>
                    </tr>

                    <tr>
                        <td><label id="lozinkal" for="lozinka">Lozinka</label></td>
                        <td><input id="lozinka" required="required" pattern=".{6,}" name="lozinka" placeholder="lozinka" type="password"></td>
                    </tr>

                    <tr>
                        <td><label id="lozinka2l" for="lozinka2">Potvrda lozinke</label></td>
                        <td><input id="lozinka2" required="required" pattern=".{6,}" name="lozinka2" placeholder="potvrda lozinke" type="password"></td>
                    </tr>

                    <tr>
                        <td><label id="gradl" for="grad">Grad</label></td>
                        <td><input id="grad" name="grad"></td>
                    </tr>

                    <tr>
                        <td><label id="uvjetil" for="uvjeti">prihvaćam uvjete</label></td>
                        <td><input id="uvjeti" required="required" name="uvjeti" type="checkbox"></td>
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