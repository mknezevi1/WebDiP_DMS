<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ispis korisnika</title>
        <link rel="stylesheet" href="../css/mknezevi1.css"/>
        <link rel="stylesheet" href="../css/zaprint.css" media="print"/>
        <link rel="stylesheet" href="../css/jquery.dataTables.css"/>

        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        <div id="staticko">
            <section id="zagljavlje">
                <img src = "../slike/mk1.png" alt = "MatijaKnezevic_slika" width="1214" height="295"/>
            </section>
        </div> 

        <div id="dinamicko">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');

            require_once('../baza/korisnici.php'); //fatal error ako se korisnici.php ne uspije uključiti

            $baza = new Baza();
            $korisnici = $baza->dajKorisnike();

            echo "<table id='tablica'>";
            echo "<thead><tr><th>korisničko ime</th><th>ime</th><th>prezime</th><th>email</th><th>lozinka</th></tr></thead>";
            echo "<tbody>";
            foreach ($korisnici as $korisnik) {
                echo "<tr>";
                echo "<td>" . $korisnik['korime'] . "</td>";
                echo "<td>" . $korisnik['ime'] . "</td>";
                echo "<td>" . $korisnik['prezime'] . "</td>";
                echo "<td>" . $korisnik['email'] . "</td>";
                echo "<td>" . $korisnik['lozinka'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>
            <script>$('#tablica').dataTable();</script>
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
