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

if (!(isset($data['id'])) ||
    (strlen($data['id']) == 0)
) {
    $array = [false, "Nie uzupełniono id"];
    echo json_encode($array);
    exit();
}

$id = htmlentities($data['id'], ENT_HTML5, "UTF-8");

require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $array = [false, "Nie połączono się z bazą danych"];
    echo json_encode($array);
    exit();
}

$sql = "SELECT id from dania";
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
    $array = [false, "Nie ma dania o podanym id"];
    echo json_encode($array);
    exit();
}

$sql = sprintf("DELETE FROM `dania` WHERE `dania`.`id` = '%s'",
    mysqli_real_escape_string($link, $id));


if ($result = mysqli_query($link, $sql)) {
    $array = [true, "Pomyślnie usunięto danie."];
} else {
    $array = [false, "Nie usunięto dania - błąd:" . mysqli_error($link)];
}

mysqli_close($link);

echo json_encode($array);