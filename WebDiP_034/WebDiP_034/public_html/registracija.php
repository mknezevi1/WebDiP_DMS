<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>registracija</title>  
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

            <form id="formaregistracija" method="post" action="provjera.php">
                <table>
                    <tr>
                        <td><input id="id" name="id" type="hidden" value="-1"></td>
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
                        <td><input id="ime" required="required"  name="ime" placeholder="ime" autofocus="autofocus"></td>
                    </tr>

                    <tr>
                        <td><label id="prezimel" for="prezime">Prezime</label></td>
                        <td><input id="prezime" required="required" name="prezime" placeholder="prezime"></td>
                    </tr>

                    <tr>
                        <td><label id="emaill" for="email">E-mail</label></td>
                        <td><input id="email" required="required" name="email" placeholder="email" type="email"></td> 
                    </tr>

                    <tr>
                        <td><label id="korimel" for="korime">Korisničko ime</label></td>
                        <td><input id="korime" required="required" pattern=".{6,}" name="korime" placeholder="korisničko ime"></td>
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