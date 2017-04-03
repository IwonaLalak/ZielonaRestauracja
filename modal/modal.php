<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 06.01.17
 * Time: 22:11
 */
session_start();


echo <<<END

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Zaloguj się</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <form class="form-horizontal" name="login_on_account" method="post">
                            <div class="form-group">
                                <label>Login</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_login" id="user_login"/>
                            </div>
                            <div class="form-group">
                                <label>Hasło</label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="user_password" id="user_pass" />
                            </div>
                                   <div class="form-group last_form-group">
                                       <div id="log_alert">
                                       </div>
                                   </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4 col-md-3">
                                        <a href="rejestracja.php" class="go_to_register">Nie mam konta</a>
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                        <a href="forget.php" class="go_to_register">Zapomniałem hasła</a>
                                    </div>
                                    <div class="col-xs-4 col-md-3 col-md-offset-2">
                                        <input type="submit" class="btn btn-green btn-block" value="Zaloguj się" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


END;

echo <<<END
    
    
    <script src="resources/jQuery/jQuery.js"></script>
    <script src="resources/bootstrap/js/bootstrap.js"></script>

    <!--
    <script type="text/javascript">
        console.log("zle dane");
        $('#myModal').modal('show');
    </script>
    -->

    <script src="js_files/send_by_ajax.js"></script>
    <script>
        $('.form-horizontal').on('submit', function (e) {
    
            if($(this).prop('name')=="login_on_account"){
                var login = $("#user_login").val()
                    , pass = $("#user_pass").val()
                    , log_params = '&login=' + login + '&pass=' + pass + '&action=login';
    
                wyslij(log_params,"php_files/login.php",e,$(this),$('#log_alert'),"index.php",false,false);
            }
    
        });
   
    </script>

END;

