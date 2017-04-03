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

$id = $data['id'];
$grupa = $data['grupa'];

if (
    !(isset($_POST)) ||
    (strlen($id) == 0) ||
    (strlen($grupa) == 0)
) {
    $array = [false, "Uzupełnij poprawnie dane"];
    echo json_encode($array);
    exit();
}
if ($grupa != 1 && $grupa != 2) {
    $array = [false, "Wypisano niełaściwy numer grupy. Dostępne to: 1 dla admina i 2 dla usera"];
    echo json_encode($array);
    exit();
}

$id = htmlentities($id, ENT_HTML5, "UTF-8");
$grupa = htmlentities($grupa, ENT_HTML5, "UTF-8");

if ($id == "1" && $grupa == "2") {
    $array = [false, "Nie można ściągnąć uprawnień głównemu adminowi"];
    echo json_encode($array);
    exit();
}

require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $array = [false, "Nie połączono się z bazą danych"];
    echo json_encode($array);
    exit();
}

$sql = "SELECT id from users";
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
    $array = [false, "Nie ma użytkownika o podanym id"];
    echo json_encode($array);
    exit();
}

$sql = sprintf("UPDATE `users` SET `grupa` = '%s' WHERE `users`.`id` = '%s'",
    mysqli_real_escape_string($link, $grupa),
    mysqli_real_escape_string($link, $id));


if ($result = mysqli_query($link, $sql)) {
    $array = [true, "Pomyślnie nadano uprawnienia."];
} else {
    $array = [false, "Nie nadano uprawnienia - błąd:" . mysqli_error($link)];
}

mysqli_close($link);

echo json_encode($array);
