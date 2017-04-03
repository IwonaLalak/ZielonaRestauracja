<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 06.01.17
 * Time: 22:03
 */
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aplikacje internetowe - Projekt 2</title>
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/import.css">
</head>
<body id="forget_page">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h3>Odzyskiwanie hasła</h3>
            </div>
        </div>
        <!-- SPACE -->
        <div style="height:30px;"></div>

        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <form class="form-horizontal" action="php_files/forget_pass.php" method="post">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-5 col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-xs-7 col-md-8">
                                <input type="email" class="form-control" name="user_email"/>
                            </div>
                        </div>
                    </div>

                    <!-- SPACE -->
                    <div style="height:30px;"></div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-blue center-block" value="Wyślij email"/>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['forget_error'] != false) {
                        printf('<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                ' . "%s" . '
                                            </div>
                                        </div>
                                    </div>
                                </div>',
                            $_SESSION['forget_error']);
                    }
                    $_SESSION['forget_error'] = false;
                    ?>
                </form>
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

