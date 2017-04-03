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
$glowna = $data['glowna'];
$mniejsza = $data['mniejsza'];

if (!(isset($_POST)) || (strlen($glowna) < 5) || (strlen($glowna) > 200)
) {
    $array = [false, "Uzupełnij poprawnie dane. Treść główna jest wymagana. Zakres znaków wynosi 5 - 200"];
    echo json_encode($array);
    exit();
}
$glowna = htmlentities($glowna, ENT_HTML5, "UTF-8");

if (strlen($mniejsza) == 0) {
    $mniejsza = "";
} else {
    $mniejsza = htmlentities($mniejsza, ENT_HTML5, "UTF-8");
}

require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $array = [false, "Brak połączenia z bazą: " . mysqli_connect_error()];
    echo json_encode($array);
    exit();
}

if (isset($_POST)) {
    $sql = sprint("INSERT INTO `promocje` (`id`, `tekst_glowny`, `tekst_mniejszy`, `data`) VALUES (NULL, '%s', '%s', CURRENT_TIMESTAMP)",
        mysqli_real_escape_string($link, $glowna),
        mysqli_real_escape_string($link, $mniejsza));

    if ($result = mysqli_query($link, $sql)) {

        $array = [true, "Pomyślnie dodano promocje"];
    } else {
        $array = [false, 'Nie dodano promocji - błąd: ' . mysqli_error($link)];
    }
    mysqli_free_result($result);
    mysqli_close($link);

} else {
    $array = [false, 'Nie dodano promocji - błąd: ' . mysqli_error($link)];
}

echo json_encode($array);

