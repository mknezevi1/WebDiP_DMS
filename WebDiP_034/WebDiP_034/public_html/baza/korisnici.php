<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

class Baza {

    public $_host = "localhost";
    public $_user = "WebDiP2012_034";
    public $_database = "WebDiP2012_034";
    public $_pass = "admin_bM8g";

    function upit() {
        
    }

    function dbSpoji() {
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        }
        else
            $conn->set_charset("utf8");
        return $conn;
    }

    function dajKorisnike() {
        $korisnici = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");

            $sql = "SELECT * FROM korisnik";
            $rs = $conn->query($sql);
            if ($rs) {
                while ($red = $rs->fetch_assoc()) {
                    $korisnici[] = $red;
                }
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $korisnici;
        $conn->close();
    }
    
    function generirajLozinku($email, $lozinka) {
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");

            $sql = "UPDATE korisnik SET lozinka = '" . $lozinka . "' WHERE email = '$email'";
            $rs = $conn->query($sql);
            if ($rs) {
               //ok
                }
             else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return;
        $conn->close();
    }
    
    function dajStatistiku() {
        $polje = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");

            $sql = "SELECT count(*) AS br FROM korisnik";
            $rs = $conn->query($sql);
            if ($rs) {
                $red = $rs->fetch_assoc();
                $polje[0] = $red['br'];
            } else {
                echo $conn->error . " upit:" . $sql;
            }

            $sql = "SELECT count(*) AS br FROM dokument";
            $rs = $conn->query($sql);
            if ($rs) {
                $red = $rs->fetch_assoc();
                $polje[1] = $red['br'];
            } else {
                echo $conn->error . " upit:" . $sql;
            }

            $sql = "SELECT count(*) AS br FROM verzija_dokumenta";
            $rs = $conn->query($sql);
            if ($rs) {
                $red = $rs->fetch_assoc();
                $polje[2] = $red['br'];
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $polje;
        $conn->close();
    }

    function ispitajKorisnike($korisnik) {
        $korisnici = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");

            $sql = "SELECT * FROM korisnik where korime = '" . $korisnik . "'";
            $rs = $conn->query($sql);
            if ($rs) {
                while ($red = $rs->fetch_assoc()) {
                    $korisnici[] = $red;
                }
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $korisnici;
        $conn->close();
    }

    function dajDatoteke() {
        $datoteke = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");

            $sql = "SELECT v.dokument, v.naziv, v.vrijeme, k.korime FROM  verzija_dokumenta v, korisnik k WHERE v.autor = k.id";
            $rs = $conn->query($sql);
            if ($rs) {
                while ($red = $rs->fetch_assoc()) { //hvala rezultat kao asocijativni niz (nema indexe nego [ime]...)
                    $datoteke[] = $red;
                }
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $datoteke;
        $conn->close();
    }

    function upisiKorisnika($id, $korime, $ime, $prezime, $lozinka, $email, $grad) {
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);

        $vrijeme = date('Y.m.d H:i:s');

        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");
            if ($id === "-1") {
                $sql = 'INSERT INTO korisnik(korime, ime, prezime, lozinka, email, tip, prava, grad) ';
                $sql .= 'VALUES ("' . $korime . '","' . $ime . '","' . $prezime . '","' . $lozinka . '","' . $email . '", "1" , "1","' . $grad . '")';
            } else {
                $sql = "UPDATE korisnik SET korime = '" . $korime . "',ime = '" . $ime . "',prezime = '" . $prezime . "',lozinka = '" . $lozinka . "',email = '" . $email . "' ,grad = '" . $grad . "' WHERE id = '$id'";
            }
            $rs = $conn->query($sql);
            if ($rs) {
                //echo "ok";
                $errorMessage = $vrijeme . " Azuriranje korisnika:" . $korime . "\n";
                error_log($errorMessage, 3, "info.log"); //3 : message is appended to the file destination. 
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return;
        $conn->close();
    }

    function upisiDokument($slika, $ekstenzija) {
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");
            $sql = 'INSERT INTO dokument(slika, ekstenzija) ';
            $sql .= 'VALUES ("' . $slika . '","' . $ekstenzija . '")';
            $rs = $conn->query($sql);
            if ($rs) {
                //echo "ok";
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        $id = $conn->insert_id;
        return $id;
        $conn->close();
    }

    function urediPrava($id, $prava, $tip, $nopomena) {
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");
            $sql = "UPDATE korisnik SET prava = '" . $prava . "',tip = '" . $tip . "', nopomena = nopomena + '" . $nopomena . "' WHERE id = '$id'";
            $rs = $conn->query($sql);
            if ($rs) {
                //echo "ok";
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return;
        $conn->close();
    }

    function upisiDatoteku($naziv, $dokument, $autor, $vrijeme) {
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {
            $conn->set_charset("utf8");
            $sql = 'INSERT INTO verzija_dokumenta(naziv, dokument, autor, vrijeme) ';
            $sql .= 'VALUES ("' . $naziv . '", "' . $dokument . '", "' . $autor . '", "' . $vrijeme . '")';
            $rs = $conn->query($sql);
            if ($rs) {
                //echo "ok";
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return;
        $conn->close();
    }

}

?>
