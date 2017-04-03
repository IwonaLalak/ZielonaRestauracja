/**
 * Created by Iwona on 15.01.17.
 */

function wyslij(parametry, cel, event, form, alert_place, redirect_to, skad_odczyt, wyswietl_w) {
    function redirect(to, delay) {
        window.setTimeout(function () {
            window.location.href = to;
        }, delay);
    }

    function progress() {
        var start = new Date();
        var maxTime = 1400;
        var timeoutVal = Math.floor(maxTime / 100);
        animateUpdate();

        function updateProgress(percentage) {
            $('.progress-bar').css("width", percentage + "%");
        }

        function animateUpdate() {
            var now = new Date();
            var timeDiff = now.getTime() - start.getTime();
            var perc = Math.round((timeDiff / maxTime) * 100);
            console.log(perc);
            if (perc <= 100) {
                updateProgress(perc);
                setTimeout(animateUpdate, timeoutVal);
            }
        }
    }

    function hide(delay) {
        window.setTimeout(function () {
            alert_place.fadeOut();
        }, delay);
    }

    var request = $.ajax(
        {
            url: cel,
            type: "POST",
            datatype: "json",
            data: parametry
        });


    request.done(function (html) {
        var array = $.parseJSON(html);

        if (array[0] == true) {
            alert_place.removeClass('alert alert-danger');
            alert_place.addClass('alert alert-success').text(array[1]);
            if (redirect_to != false) {
                redirect(redirect_to, 1500);

                $('<div class="progress"><div class="progress-bar progress-bar-success" ' +
                    'role="progressbar" aria-valuenow="0" aria-valuemin="0" ' +
                    'aria-valuemax="100" style="width:1%;"><span class="sr-only">' +
                    '...</span></div></div>').appendTo(alert_place);
                progress();
            }
            else {
                hide(1500);
                if (wyswietl_w != false) {
                    pobranie_danych(skad_odczyt, wyswietl_w);
                    if (wyswietl_w[0].id == 'wykaz_oczekujacych') {
                        pobranie_danych('php_files/all_zamowienia.php', $('#wykaz'));
                    }
                }

            }
        }
        else if (array[0] == false) {
            alert_place.addClass('alert alert-danger').text(array[1]);
        }

    });

    event.preventDefault();
    form.trigger('reset');
}