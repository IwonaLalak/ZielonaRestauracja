<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 04.01.17
 * Time: 13:40
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$data = array_map('trim', $_POST);
$data = array_map('strip_tags', $_POST);

$id = htmlentities($data['id'], ENT_HTML5, "UTF-8");

if (strlen($id) == 0 || !(isset($_POST))) {
    $array = [false, "Nie uzupełniono wszystkich danych"];
    echo json_encode($array);
    exit();
}

require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $array = [false, "Brak połączenia z bazą: " . mysqli_connect_error()];
    echo json_encode($array);
    exit();
}

$sql = "SELECT id from zamowienia";
$all_ids = "";

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $all_ids = ' ' . $all_ids . $row["id"] . ' ';
        }
    }
    mysqli_free_result($result);
}

if (strpos($all_ids, $id) == false) {
    $array = [false, "Nie ma zamówienia o podanym id"];
    echo json_encode($array);
    exit();
}

if (isset($_POST)) {
    $sql = sprintf("UPDATE `zamowienia` SET `zrealizowane` = 'tak' WHERE `zamowienia`.`id` = '%s'",
        mysqli_real_escape_string($link, $id));
    if ($result = mysqli_query($link, $sql)) {

        $array = [true, "Pomyślnie zrealizowano zamówienie"];
    } else {
        $array = [false, 'Nie zrealizowano zamówienia - błąd: ' . mysqli_error($link)];
    }
    mysqli_free_result($result);
    mysqli_close($link);

} else {
    $array = [false, 'Nie zrealizowano zamówienia - błąd: ' . mysqli_error($link)];
}

echo json_encode($array);
