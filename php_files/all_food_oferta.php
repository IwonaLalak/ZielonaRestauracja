<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 07.01.17
 * Time: 23:46
 */

require_once 'connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    echo 'Brak połączenia z bazą: ' . mysqli_connect_error();
    exit();
}

$dania[0] = "Dania obiadowe";
$dania[1] = "Zupy";
$dania[2] = "Sałatki";
$dania[3] = "Napoje";

for ($i = 0; $i < count($dania); $i++) {

    $sql = "SELECT * FROM dania WHERE `dania`.`kategoria`='$dania[$i]'";

    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {

            printf('
            <div class="row">
            <div class="col-xs-12 col-md-12">
                <h3>' . "%s" . '</h3>
            </div>
            <div class="col-xs-12 col-md-12">
                <table class="table table-responsive table-hover">',
                $dania[$i]);

            while ($row = mysqli_fetch_assoc($result)) {

                printf('
                    <tr>
                        <td class="col-xs-3 col-md-2">
                            <div class="thumbnail">
                                <img src="' . "%s" . '" class="img-responsive" />
                            </div>
                        </td>
                        <td class="col-xs-7 col-md-9 description">
                            ' . "%s" . '
                        </td>
                        <td class="col-xs-2 col-md-1">
                                <span class="badge">
                                    ' . "%s" . 'zł
                                </span>
                        </td>
                    </tr>
                             
                            '
                    , $row["url"], $row["nazwa"], $row["cena"]);
            }

            print('</table>
            </div>
        </div>
        <div style="height:30px;"></div>');

        }
        mysqli_free_result($result);
    } else {
        echo 'Nie można wyświetlić danych';
    }
}

mysqli_close($link);


