/**
 * Created by Iwona on 15.01.17.
 */

function pobranie_danych(skad, wyswietl_w) {

    $.ajax({
        type: "GET",
        url: skad,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',

        success: function (json) {

            wyswietl_w.text("");

            var tab = [];
            var wiersz = json[0];
            for (var pole in wiersz) {
                tab.push(pole);
            }

            for (var data in json) {
                var wiersz = json[data];

                var row = "";
                row += ("<tr>");

                for (var i = 0; i < tab.length; i++) {
                    if (tab[i] == "url") {
                        row += ('<td class="col-md-1 col-xs-1"><div class="thumbnail"><img src="' +
                        wiersz[tab[i]] +
                        '" class="img-responsive" /></div></td>');

                    } else {
                        row += ("<td>" +
                        wiersz[tab[i]] +
                        "</td>");
                    }
                }

                row += ("</tr>");
                $(row).appendTo(wyswietl_w);

            }

        },

        error: function (blad) {
            console.log(blad);
        }

    });

};