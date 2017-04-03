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
<body id="panel_page">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Witaj
                    <?php echo $_SESSION['login']; ?>
                </h3>
            </div>
        </div>
        <!-- SPACE -->
        <div style="height: 40px"></div>

        <div class="row" id="buttony_zarzadzania">
            <div class="col-xs-12 col-md-12">
                <a href="uzytkownicy.php" class="btn btn-cyan btn-block">Zarządzanie użytkownikami</a>
            </div>
            <div class="col-xs-12 col-md-12">
                <a href="zamowienia.php" class="btn btn-cyan btn-block">Zarządzanie zamówieniami</a>
            </div>
            <div class="col-xs-12 col-md-12">
                <a href="dania.php" class="btn btn-cyan btn-block">Zarządzanie daniami</a>
            </div>
            <div class="col-xs-12 col-md-12">
                <a href="promocje.php" class="btn btn-cyan btn-block">Zarządzanie promocjami</a>
            </div>
        </div>


        <!-- SPACE -->
        <div style="height: 40px"></div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-12 col-md-3 col-lg-2">
                                <h4>
                                    <span class="glyphicon glyphicon-cog"></span>
                                    Zmień hasło:
                                </h4>
                            </div>
                            <div class="col-xs-12 col-md-9 col-lg-10">
                                <form class="form-horizontal" method="post" action="php_files/change_pass.php">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4 col-lg-5">
                                            <input type="password" class="form-control" placeholder="podaj obecne"/>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-lg-5">
                                            <input type="password" class="form-control" placeholder="podaj nowe"/>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-lg-2">
                                            <input type="submit" class="btn btn-red btn-block" value="Zatwierdź"/>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['password_change_error']) && $_SESSION['password_change_error'] != false)
                                        printf('
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                ' . "%s" . '
                                            </div>
                                        </div>
                                    </div>'
                                            , $_SESSION['password_change_error']);
                                    $_SESSION['password_change_error'] = false;
                                    ?>
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
            <form class="col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" action="php_files/logout.php">
                <input type="submit" class="btn btn-blue btn-block" value="Wyloguj się"/>
            </form>
        </div>

    </div>
    <?php
    require_once 'footer/footer.php';
    ?>
</body>
</html>
<script src="resources/jQuery/jQuery.js"></script>
<script src="resources/bootstrap/js/bootstrap.js"></script>
