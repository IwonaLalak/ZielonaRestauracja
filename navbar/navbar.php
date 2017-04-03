<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 06.01.17
 * Time: 22:11
 */

session_start();

echo <<<END

<div id="up_header"></div>
<div id="header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">RESTAURACJA</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="oferta.php">OFERTA</a></li>
                    <li><a href="zamow.php">ZAMÓW</a></li>
                    <li><a href="kontakt.php">KONTAKT</a></li>
END;

if ($_SESSION['zalogowany'] == false) {
    echo '<li><a data-toggle="modal" data-target="#myModal" style="cursor: pointer">ZALOGUJ</a></li>';
} else if ($_SESSION['zalogowany'] == true) {
    if ($_SESSION['grupa'] == '2') {
        echo '<li><a href="profil.php">PROFIL</a></li>';
    } else if ($_SESSION['grupa'] == '1') {
        echo '<li><a href="panel.php">PANEL</a></li>';
    }
}

echo <<<END
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>


END;
