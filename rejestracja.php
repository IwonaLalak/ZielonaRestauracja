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
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body id="rejestracja_page">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h3>Rejestracja nowego konta</h3>
            </div>
        </div>

        <!-- SPACE -->
        <div style="height:30px;"></div>

        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <form class="form-horizontal" name="register_new_account" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-5 col-md-4">
                                <label>Login</label>
                            </div>
                            <div class="col-xs-7 col-md-8">
                                <input type="text" class="form-control" name="user_login" id="user_login"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-5 col-md-4">
                                <label>Hasło</label>
                            </div>
                            <div class="col-xs-7 col-md-8">
                                <input type="password" class="form-control" name="user_password" id="user_password"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-5 col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-xs-7 col-md-8">
                                <input type="email" class="form-control" name="user_email" id="user_email"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="g-recaptcha" data-sitekey="6LdIxBEUAAAAAJdQkhRCOia1o4hQsPGgDBg-cKVA"></div>
                             </div>

                             <div class="col-md-6">-->
                                <input type="submit" class="btn btn-blue center-block" style="margin-top:20px;"
                                       value="Zarejestruj"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group last_form-group">
                        <div id="reg_alert">
                        </div>
                    </div>
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
<script src="js_files/send_by_ajax.js"></script>
<script>
    $('.form-horizontal').on('submit', function (e) {

        if ($(this).prop('name') == "register_new_account") {
            var login = $("#user_login").val()
                , pass = $("#user_password").val()
                , email = $("#user_email").val()
                , reg_params = '&login=' + login + '&pass=' + pass + '&email=' + email + '&action=register';

            wyslij(reg_params, "php_files/register.php", e, $(this), $('#reg_alert'), "index.php", false, false);
        }

    });

</script>
