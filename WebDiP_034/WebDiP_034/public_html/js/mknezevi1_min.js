var forma = document.forms[0];

var input = document.getElementsByTagName("input"); //polje elemenata s tagom input
for (var i = 0; i < input.length; i++) {
    input[i].addEventListener("focus", function() { //svim inputima daj eventlistener na event focus
        this.className = "fokus"; //označi ih ovako
    });
    input[i].addEventListener("blur", function() { //svim inputima na blur(gubitak focusa) 
        this.className = ""; //makni klasu
    });
}

var labela = document.getElementsByTagName("label");
for (var i = 0; i < labela.length; i++) {
    labela[i].addEventListener("mouseover", function() { //misem iznad
        this.className = "hover";
    });
    labela[i].addEventListener("mouseout", function() { //misem se maknut
        this.className = "";
    });
}

        