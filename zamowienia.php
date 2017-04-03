<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 06.01.17
 * Time: 22:03
 */

session_start();

if ($_SESSION['zalogowany'] == false || $_SESSION['grupa'] != '1') {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aplikacje internetowe - Projekt 2</title>
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/import.css">
</head>
<body id="panel_page_zamowienia">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Podgląd oczekujących zamówień</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="well wyswietlenie_tabeli">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>data</td>
                            <td>imie</td>
                            <td>nazwisko</td>
                            <td>adres</td>
                            <td>telefon</td>
                            <td>dodatkowe inf.</td>
                            <td>dania | ilość</td>
                            <td>kwota</td>
                            <td>zrealizowane</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tbody id="wykaz_oczekujacych">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SPACE -->
        <div style="height: 40px"></div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="post" name="oznacz_jako_zrealizowane">
                                    <div class="form-group">
                                        <div class="col-xs-4 col-md-4">
                                            <label>
                                                <span class="glyphicon glyphicon-check"></span>
                                                Oznacz jako zrealizowane
                                            </label>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="number" class="form-control" placeholder="ID" name="id"
                                                   id="oznacz_id"/>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="submit" class="btn btn-brown btn-block" value="Oznacz"/>
                                        </div>
                                    </div>
                                    <div class="form-group last_form-group">
                                        <div class="col-md-12">
                                            <div id="ozn_alert">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <!-- SPACE -->
        <div style="height: 40px"></div>

        <div class="row">
            <div class="col-xs-6 col-md-6">
                <h3>Podgląd wszystkich zamówień</h3>
            </div>
            <div class="col-xs-6 col-md-6">
                <button class="btn btn-green" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample" style="float:right" id="pobierz_dane">
                    Wyświetl podgląd
                </button>
            </div>
        </div>
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-md-12">
                    <div class="well wyswietlenie_tabeli">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>data</td>
                                <td>imie</td>
                                <td>nazwisko</td>
                                <td>adres</td>
                                <td>telefon</td>
                                <td>dodatkowe inf.</td>
                                <td>dania | ilość</td>
                                <td>kwota</td>
                                <td>zrealizowane</td>
                            </tr>
                            </thead>
                            <tbody id="wykaz">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- SPACE -->
        <div style="height: 40px"></div>

        <div class="row" id="buttony_zarzadzania">
            <div class="col-xs-6 col-md-3">
                <a href="uzytkownicy.php" class="btn btn-cyan btn-block">Zarządzanie uzytkownikami</a>
            </div>
            <div class="col-xs-6 col-md-3">
                <a href="dania.php" class="btn btn-cyan btn-block">Zarządzanie daniami</a>
            </div>
            <div class="col-xs-6 col-md-3">
                <a href="promocje.php" class="btn btn-cyan btn-block">Zarządzanie promocjami</a>
            </div>
            <div class="col-xs-6 col-md-3">
                <a href="panel.php" class="btn btn-block">Powrót do panelu</a>
            </div>
        </div>

    </div>
    <?php
    require_once 'footer/footer.php';
    ?>
</body>
</html>
<script src="resources/jQuery/jQuery.js"></script>
<script src="resources/bootstrap/js/bootstrap.js"></script>
<script src="js_files/get_by_ajax.js"></script>
<script>

    window.onload = pobranie_danych('php_files/all_zamowienia_oczekujace.php', $('#wykaz_oczekujacych'));
    $('#pobierz_dane').click(pobranie_danych('php_files/all_zamowienia.php', $('#wykaz')));

</script>

<script src="js_files/send_by_ajax.js"></script>
<script>
    $('.form-horizontal').on('submit', function (e) {

        if ($(this).prop('name') == "oznacz_jako_zrealizowane") {
            var id = $("#oznacz_id").val()
                , ozn_params = '&id=' + id + '&action=oznacz_jako_zrealizowane';

            wyslij(ozn_params, "php_files/zrealizuj_zamowienie.php", e, $(this), $('#ozn_alert'), false, 'php_files/all_zamowienia_oczekujace.php', $('#wykaz_oczekujacych'));
        }

    });

</script>
