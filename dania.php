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
<body id="panel_page_dania">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-6">
                <h3>Podgląd dań</h3>
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
                                <td>kategoria</td>
                                <td>nazwa</td>
                                <td>cena</td>
                                <td>zdjęcie</td>
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

        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="post" name="add_new_food">
                                    <div class="form-group">
                                        <div class="col-xs-4 col-md-4">
                                            <label>
                                                <span class="glyphicon glyphicon-plus-sign"></span>
                                                Dodaj danie
                                            </label>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <select class="form-control" name="kat" id="add_kat">
                                                <option selected="selected" value="Dania obiadowe">Dania obiadowe
                                                </option>
                                                <option value="Zupy">Zupy</option>
                                                <option value="Sałatki">Sałatki</option>
                                                <option value="Napoje">Napoje</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="text" class="form-control" placeholder="nazwa" name="nazwa"
                                                   id="add_nazwa"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-4 col-md-4">
                                            <input type="url" class="form-control" placeholder="URL" name="url"
                                                   id="add_url"/>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="text" class="form-control" placeholder="cena" name="cena"
                                                   id="add_cena"/>
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <input type="submit" class="btn btn-brown btn-block" value="Dodaj"/>
                                        </div>
                                    </div>
                                    <div class="form-group last_form-group">
                                        <div class="col-md-12">
                                            <div id="add_alert">
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

        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="post" name="del_food">
                                    <div class="form-group">
                                        <div class="col-xs-4 col-md-4">
                                            <label>
                                                <span class="glyphicon glyphicon-minus-sign"></span>
                                                Usuń danie
                                            </label>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="number" class="form-control" placeholder="ID" name="id"
                                                   id="del_id"/>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="submit" class="btn btn-brown btn-block" value="Usuń"/>
                                        </div>
                                    </div>
                                    <div class="form-group last_form-group">
                                        <div class="col-md-12">
                                            <div id="del_alert">
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

        <div class="row" id="buttony_zarzadzania">
            <div class="col-xs-6 col-md-3">
                <a href="uzytkownicy.php" class="btn btn-cyan btn-block">Zarządzanie uzytkownikami</a>
            </div>
            <div class="col-xs-6 col-md-3">
                <a href="zamowienia.php" class="btn btn-cyan btn-block">Zarządzanie zamówieniami</a>
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

    $('#pobierz_dane').click(pobranie_danych('php_files/all_food.php', $('#wykaz')));

</script>

<script src="js_files/send_by_ajax.js"></script>
<script>
    $('.form-horizontal').on('submit', function (e) {

        if ($(this).prop('name') == "add_new_food") {
            var nazwa = $("#add_nazwa").val()
                , kat = $("#add_kat").val()
                , url = $("#add_url").val()
                , cena = $("#add_cena").val()
                , add_params = '&nazwa=' + nazwa + '&kat=' + kat + '&url=' + url + '&cena=' + cena + '&action=addfood';

            wyslij(add_params, "php_files/add_food.php", e, $(this), $('#add_alert'), false, 'php_files/all_food.php', $('#wykaz'));
        }
        else if ($(this).prop('name') == "del_food") {
            var id = $("#del_id").val()
                , del_params = '&id=' + id + '&action=delfood';

            wyslij(del_params, "php_files/del_food.php", e, $(this), $('#del_alert'), false, 'php_files/all_food.php', $('#wykaz'));
        }

    });

</script>
