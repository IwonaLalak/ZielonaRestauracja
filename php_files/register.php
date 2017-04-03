<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 04.01.17
 * Time: 13:40
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
$email = $data['email'];
$pass = htmlentities($data['pass'], ENT_HTML5, "UTF-8");

if (!(isset($_POST)) ||
    (strlen($login) < 3) || (strlen($login) > 30) ||
    (strlen($email) < 3) || (strlen($email) > 50) ||
    (strlen($pass) < 3) || (strlen($pass) > 30)
) {
    $array = [false, "Login / hasło / email muszą się mieścić w zakresie 3 - 30 (email: 50) znaków"];
    echo json_encode($array);
    exit();
}
$pass = md5($pass);


require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $array = [false, "Brak połączenia z bazą: " . mysqli_connect_error()];
    echo json_encode($array);
    exit();
}

if (isset($_POST)) {
    $sql = sprintf(
        "INSERT INTO `users` (`id`, `login`, `password`, `email`, `grupa`, `rabat`) VALUES (NULL, '%s', '%s', '%s', '2', 'Brak rabatu')",
        mysqli_real_escape_string($link, $login),
        mysqli_real_escape_string($link, $pass),
        mysqli_real_escape_string($link, $email));


    if ($result = mysqli_query($link, $sql)) {
        $_SESSION['zalogowany'] = true;
        $_SESSION['grupa'] = '2';
        $_SESSION['login'] = $login;
        $_SESSION['rabat'] = "Brak rabatu";
        mysqli_free_result($result);
        $array = [true, "Pomyślnie zalogowano. Nastąpi przekierowanie do strony głównej"];
    } else {
        $array = [false, 'Błąd rejestracji - podany login bądź email jest zajęty: ' . mysqli_error($link)];
    }
}

mysqli_close($link);
echo json_encode($array);
