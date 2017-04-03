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


$sql = "SELECT * FROM dania ";

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {

            printf('
                            <div class="col-xs-7 col-md-7 col-lg-4 nazwa_dania">
                                <div class="row">
                                    <div class="col-xs-2 col-md-1">
                                        <input type="checkbox" class="checkbox" value="' . "%s" . '" name="dania[]" id="c' . $i . '"/>
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <span>' . "%s" . '</span>
                                    </div>
                                    <div class="col-xs-2 col-md-2">
                                        <span class="cena_dania">' . "%s" . 'zł</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-5 col-md-5 col-lg-1">
                                <input type="number" class="form-control" value="0" name="ilosc[]" id="n' . $i . '"/>
                            </div>
                             
                            '
                , $row["nazwa"], $row["nazwa"], $row["cena"]);
            $i++;
        }


    } else {
        echo 'Brak dań w karcie';
    }
    mysqli_free_result($result);
} else {
    echo 'Nie można wyświetlić danych';
}


mysqli_close($link);


