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
<body id="kontakt_page">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-5">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Dane Kontaktowe</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            <span class="glyphicon glyphicon-asterisk"></span>
                            <span>Restauracja</span>
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <span>Pigonia 1, Rzeszów</span>
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>
                            <span class="glyphicon glyphicon-envelope"></span>
                            <span>restauracja@email.com</span>
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>
                            <span class="glyphicon glyphicon-phone-alt"></span>
                            <span> 16 000 00 00</span>
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <h4>
                            <span class="glyphicon glyphicon-phone"></span>
                            <span> +48 000 000 000</span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="thumbnail">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d761.8111853282821!2d22.004126224159755!3d50.04101586997209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473cfb02df7c525b%3A0x3d3903b0a090a3ad!2sAdama+Asnyka%2C+Rzesz%C3%B3w!5e0!3m2!1spl!2spl!4v1477166076639"
                            width="100%" height="300px" frameborder="0"
                            style="border:1px solid #ddd;border-radius:4px" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row" id="formularz_name">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Formularz Kontaktowy</h3>
                    </div>
                </div>

                <div class="col-md-12">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label>Temat wiadomości</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Temat wiadomości"/>
                        </div>
                        <div class="form-group">
                            <label>Tekst wiadomości</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Tekst wiadomości"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label style="line-height: 38px;">Twój email</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="email" class="form-control" placeholder="Twój email"/>
                                </div>
                                <div class="col-md-5">
                                    <button type="button" class="btn btn-blue btn-block">Wyślij wiadomość</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>

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
