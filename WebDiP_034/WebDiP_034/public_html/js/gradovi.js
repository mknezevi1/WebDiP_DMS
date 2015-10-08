function skiniGradove() {
    var poljeGradova = new Array();
    $.getJSON("podaci/gradovi.json", function(data) {
        $.each(data, function(index, value) {
            poljeGradova.push(value);
        });
    });
    return poljeGradova; // vrati polje gradova
}

$(function() {
    var poljeGradova = skiniGradove();
    $("#grad").autocomplete({
        source: poljeGradova //vadi iz napravljenog polja gradova
    });
});
