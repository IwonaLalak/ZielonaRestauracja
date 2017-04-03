<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 06.01.17
 * Time: 22:03
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aplikacje internetowe - Projekt 2</title>
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/import.css">
</head>
<body id="zamow_page">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-7">
                <h3 id="opis_tel">
                    Aby złożyć zamówienie zadzwoń pod numer:
                </h3>
            </div>
            <div class="col-xs-12 col-md-5">
                <h3 id="nr_tel">
                    <span class="glyphicon glyphicon-earphone"></span> 000 000 000
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h3 id="opis_form">bądź uzupełnij poniższy formularz:</h3>
            </div>
        </div>
        <!-- SPACE -->
        <div style="height: 30px"></div>

        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post" action="php_files/add_order.php">
                    <div class="form-group">
                        <label>Wybierz dania:</label>
                    </div>
                    <div class="form-group" id="wszystkie_dania">
                        <div class="row">

                            <?php
                            require_once 'php_files/all_food_zamowienia.php';
                            ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Podaj imię i nazwisko:</label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <input type="text" class="form-control" placeholder="Imię" name="imie"/>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <input type="text" class="form-control" placeholder="Nazwisko" name="nazwisko"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Podaj adres i telefon:</label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <input type="text" class="form-control" placeholder="Adres" name="adres"/>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <input type="number" class="form-control" placeholder="Telefon" name="telefon"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dodatkowe informacje </label>
                        <small> (nieobowiązkowe):</small>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <textarea class="form-control" name="info"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-6" id="cena_zamowienia">
                                Cena Twojego zamówienia wynosi:
                                <span class="badge" id="kwota">0 zł</span>
                                <input type="hidden" id="kwota_input" value="0" name="kwota"/>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <input type="submit" class="btn btn-blue btn-block" value="Zamów"/>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['zamow_error']) && $_SESSION['zamow_error'] != false) {
                        printf('
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger">' .
                            "%s"
                            . '</div>
                                                </div>
                                                </div>
                                            </div>'
                            , $_SESSION['zamow_error']);
                    }
                    $_SESSION['zamow_error'] = false;
                    ?>
                </form>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-md-12 col-xs-12">
                <h3 id="smacznego">Smacznego!</h3>
            </div>
        </div>-->
    </div>
</div>

<?php
require_once 'footer/footer.php';
require_once 'modal/modal.php';
?>
</body>
</html>
<script src="resources/jQuery/jQuery.js"></script>
<script src="resources/bootstrap/js/bootstrap.js"></script>

<script type="text/javascript">

    var countChecked = function () {
        var total = 0;
        $(this).parents(".nazwa_dania").css("font-weight", "normal");
        $("#wszystkie_dania input[type=number]").css('display', 'none');

        $.each($("input[type=checkbox]:checked"), function () {
            $(this).parents(".nazwa_dania").css("font-weight", "bold");
            var id_of_number = "n";
            for (var i = 1; i < $(this).attr('id').length; i++) {
                id_of_number += $(this).attr('id')[i];
            }
            $('#' + id_of_number).css('display', 'block');
            var quantity = ($('#' + id_of_number).val());
            var cena = $(this).parents(".nazwa_dania").find("span.cena_dania").text();
            cena = parseFloat((cena.substr(0, (cena.length) - 2)).replace(',', '.'));
            total += cena * quantity;
        });
        total += "";
        var k = total.indexOf('.');
        total = total.substr(0, (k + 3));
        $("#kwota").text(total + " zł");
        $("#kwota_input").val(total);
    };

    $("input[type=checkbox]").on("click", countChecked);
    $("input[type=number]").on("click", function () {
        if ($(this).val() < 0) {
            alert("Ilość nie może być ujemna");
        }
        else {
            countChecked();
        }

    });
</script>
