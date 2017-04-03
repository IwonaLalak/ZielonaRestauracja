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
<body id="index_page">
<?php
require_once 'navbar/navbar.php';
?>

<div id="bottom_header">
    <div class="container">
        <div class="row" id="zacheta">
            <div class="col-xs-7 col-xs-offset-2 col-md-offset-2 col-md-5">
                <span>Głodny? Mamy coś dla Ciebie!</span>
                <small>U nas zjesz szybko, zdrowo i tanio</small>
            </div>
            <div class="col-xs-3 col-md-2">
                <span class="glyphicon glyphicon-time"></span>
                <span class="glyphicon glyphicon-cutlery"></span>
                <span class="glyphicon glyphicon-piggy-bank"></span>
            </div>
        </div>
    </div>
</div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6" id="promocje">
                <h3>Promocje</h3>
                <ul class="list-group">
                    <?php
                    require_once 'php_files/all_promocje_index.php';
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-md-6">
                <h3>O nas</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" id="oferujemy">
            <div class="col-md-12">
                <h3>Oferujemy</h3>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail text-center">
                            <img src="images/dania/d1.jpg" class="img-responsive"/>
                            <h5>Dania obiadowe</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail text-center">
                            <img src="images/dania/z1.jpg" class="img-responsive"/>
                            <h5>Pożywne zupy</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail text-center">
                            <img src="images/dania/s1.jpg" class="img-responsive"/>
                            <h5>Zdrowe sałatki</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail text-center">
                            <img src="images/dania/n1.jpg" class="img-responsive"/>
                            <h5>Pyszne napoje</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="polub_fb">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <h3>Polub nas na Facebooku!</h3>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <a href="#">
                                    Restauracja
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
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
