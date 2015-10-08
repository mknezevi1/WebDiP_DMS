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
        <title>provjera</title>
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
            <?php
            error_reporting(E_ALL);  //ukljuci obavijesti o pogreskama
            ini_set('display_errors', 'On');

            require_once('baza/korisnici.php'); //fatal error ako se korisnici.php ne uspije uključiti

            function provjera() {
                foreach ($_POST as $k => $v)
                    if (empty($v)) {
                        echo "GREŠKA: nisu sva polja popunjena!" . "<br>";
                        return false;
                    }
                return true;
            }

            $email = $_POST['email'];

            if (!(provjera())) {
                echo "OBAVIJEST: Podaci nisu ispravno uneseni, molim popunite obrazac ponovno.";
            } else {
                echo "OBAVIJEST: Vaša lozinka je generirana i poslana na Vaš mail.";

                $baza = new Baza();

                $lozinka = "";
                $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
                $max = count($characters) - 1;
                for ($i = 0; $i < 8; $i++) {
                    $rand = mt_rand(0, $max);
                    $lozinka .= $characters[$rand];
                }

                $baza->generirajLozinku($email, $lozinka);

                $mail_to = $_POST["email"];
                $mail_from = "From: WebDiP_2012@foi.hr";
                $mail_subject = "Nova lozinka";
                $mail_body = "Vasa nova lozinka: '" . $lozinka . "'";

                mail($mail_to, $mail_subject, $mail_body, $mail_from);
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

        <script type="text/javascript" src="js/mknezevi1_min.js" ></script> 
    </body>
</html>