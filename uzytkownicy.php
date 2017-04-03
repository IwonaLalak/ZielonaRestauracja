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
<body id="panel_page_uzytkownicy">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-6">
                <h3>Podgląd użytkowników</h3>
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
                                <td>login</td>
                                <td>grupa</td>
                                <td>rabat</td>
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
                                <form class="form-horizontal" method="post" name="add_rabat">
                                    <div class="form-group">
                                        <div class="col-xs-6 col-md-6">
                                            <label>
                                                <span class="glyphicon glyphicon-plus-sign"></span>
                                                Dodaj rabat
                                            </label>
                                        </div>
                                        <div class="col-xs-6 col-md-4 col-md-offset-2">
                                            <input type="number" class="form-control" placeholder="ID" name="id"
                                                   id="add_id"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6 col-md-8">
                                            <input type="text" class="form-control" placeholder="treść" name="tresc"
                                                   id="add_tresc"/>
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
                                <form class="form-horizontal" method="post" name="del_rabat">
                                    <div class="form-group">
                                        <div class="col-xs-4 col-md-4">
                                            <label>
                                                <span class="glyphicon glyphicon-minus-sign"></span>
                                                Usuń rabat
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
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="post" name="zmien_uprawnienia">
                                    <div class="form-group">
                                        <div class="col-xs-4 col-md-4">
                                            <label>
                                                <span class="glyphicon glyphicon-user"></span>
                                                Zmień uprawnienia
                                                <small>
                                                    1 - admin, 2 - user
                                                </small>
                                            </label>
                                        </div>
                                        <div class="col-xs-2 col-md-2">
                                            <input type="number" class="form-control" placeholder="ID" name="id"
                                                   id="upr_id"/>
                                        </div>
                                        <div class="col-xs-2 col-md-2">
                                            <input type="number" class="form-control" placeholder="grupa" name="grupa"
                                                   id="upr_grupa"/>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <input type="submit" class="btn btn-brown btn-block" value="Aktualizuj"/>
                                        </div>
                                    </div>
                                    <div class="form-group last_form-group">
                                        <div class="col-md-12">
                                            <div id="upr_alert">
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
                <a href="zamowienia.php" class="btn btn-cyan btn-block">Zarządzanie zamówieniami</a>
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

    $('#pobierz_dane').click(pobranie_danych('php_files/all_users.php', $('#wykaz')));

</script>

<script src="js_files/send_by_ajax.js"></script>
<script>
    $('.form-horizontal').on('submit', function (e) {

        if ($(this).prop('name') == "add_rabat") {
            var id = $("#add_id").val()
                , tresc = $("#add_tresc").val()
                , add_params = '&id=' + id + '&tresc=' + tresc + '&action=addrabat';

            wyslij(add_params, "php_files/add_rabat.php", e, $(this), $('#add_alert'), false, 'php_files/all_users.php', $('#wykaz'));
        }
        else if ($(this).prop('name') == "del_rabat") {
            var id = $("#del_id").val()
                , del_params = '&id=' + id + '&action=delrabat';

            wyslij(del_params, "php_files/del_rabat.php", e, $(this), $('#del_alert'), false, 'php_files/all_users.php', $('#wykaz'));
        }
        else if ($(this).prop('name') == "zmien_uprawnienia") {
            var id = $("#upr_id").val()
                , grupa = $("#upr_grupa").val()
                , update_params = '&id=' + id + '&grupa=' + grupa + '&action=editgroup';

            wyslij(update_params, "php_files/update_group.php", e, $(this), $('#upr_alert'), false, 'php_files/all_users.php', $('#wykaz'));
        }

    });

</script>