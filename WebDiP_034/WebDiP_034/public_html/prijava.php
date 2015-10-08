<?php
session_start();
require_once('baza/korisnici.php');

//ako sam primio neke podatke radim obradu, inicijalno se prikazuje samo obrazac za prijavu
if (isset($_POST['korime'])) {
    $baza = new Baza();
    $conn = $baza->dbSpoji();

    $korime = $conn->real_escape_string($_POST['korime']);
    $lozinka = $conn->real_escape_string($_POST['lozinka']);

    $sql = "SELECT id, tip, prava, lozinka, nprijava FROM korisnik WHERE korime = '$korime'";
    $vrijeme = date('Y.m.d H:i:s');

    if ($rs = $conn->query($sql)) {
        $kor = $rs->fetch_assoc();
        $prava_lozinka = $kor['lozinka'];
        $id = $kor['id'];
        if ($kor['prava'] === '1') {
            if ($prava_lozinka === $lozinka) {
                $sql = "UPDATE korisnik SET nprijava = 0 WHERE id = '$id'";
                $conn->query($sql);
                $_SESSION['korime'] = $korime;
                $_SESSION['tip'] = $kor['tip'];
                $_SESSION['id'] = $kor['id'];
                $conn->close();
                $errorMessage = $vrijeme . " Uspjesna prijava:" . $korime . "\n";
                error_log($errorMessage, 3, "info.log"); //3 : message is appended to the file destination. 
                header('Location:ispis_datoteka.php');
            } else {
                $nprijava = $kor['nprijava'];
                if ($nprijava === '2') {
                    $sql = "UPDATE korisnik SET nprijava = nprijava+1, prava = 0 WHERE id = '$id'";
                    $errorMessage = $vrijeme . " Automatska blokada:" . $korime . "\n";
                    error_log($errorMessage, 3, "info.log"); //3 : message is appended to the file destination.
                } else {
                    $sql = "UPDATE korisnik SET nprijava = nprijava+1 WHERE id = '$id'";
                    $errorMessage = $vrijeme . " Neuspjesna prijava:" . $korime . "\n";
                    error_log($errorMessage, 3, "info.log"); //3 : message is appended to the file destination.
                }
                $conn->query($sql);
                $conn->close();
            }
        }
    }
}
//pri odjavi obrisem sesiju i ponovno radim redirekt na stranicu za prijavu
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
        <title>prijava</title>
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
//ako imam prijavljenog korisnika nudim mogucnost odjave, ako je neprijavljen ima link za login
            if (isset($_SESSION['korime'])) {
                echo "Dobrodošao: " . $_SESSION['korime'];
            }
            ?>
            
            <a href="zaboravljena.php">zaboravili ste lozinku?</a>
            <form id="formaprijava" method="post">
                <table>
                    <tr>
                        <td><label id="korimel" for="korime">Korisničko ime</label></td>
                        <td><input id="korime" required="required" name="korime" placeholder="korisničko ime" autofocus="autofocus"></td>
                    </tr>

                    <tr>
                        <td><label id="lozinkal" for="lozinka">Lozinka</label></td>
                        <td><input id="lozinka" required="required" name="lozinka" placeholder="lozinka" type="password"></td>
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

        <script type="text/javascript" src="js/mknezevi1_min.js" ></script> 
    </body>
</html>