<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 04.01.17
 * Time: 11:37
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$_SESSION['zalogowany'] = false;
$_SESSION['login'] = null;
$_SESSION['grupa'] = null;
$_SESSION['rabat'] = null;


$data = array_map('trim', $_POST);
$data = array_map('strip_tags', $_POST);

$login = htmlentities($data['login'], ENT_HTML5, "UTF-8");
$pass = md5(htmlentities($data['pass'], ENT_HTML5, "UTF-8"));

if (strlen($login) == 0 || strlen($pass) == 0 || !(isset($_POST))) {
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


if (isset($_POST)) {
    $sql = sprintf("SELECT id,grupa,rabat FROM users WHERE login='%s' AND password='%s'",
        mysqli_real_escape_string($link, $login),
        mysqli_real_escape_string($link, $pass));


    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                //printf ("%s (%s)\n", $row["login"], $row["id"]);
                $_SESSION['login'] = $login;
                $_SESSION['grupa'] = $row["grupa"];
                $_SESSION['rabat'] = $row["rabat"];
                break;
            }
            $_SESSION['zalogowany'] = true;
            $array = [true, "Pomyślnie zalogowano. Nastąpi przekierowanie do strony głównej"];

        } else {
            $array = [false, "Nieprawidłowe dane"];

        }
        mysqli_free_result($result);
    } else {
        $array = [false, 'Nie zalogowano - błąd: ' . mysqli_error($link)];
    }
}
mysqli_close($link);
echo json_encode($array);

