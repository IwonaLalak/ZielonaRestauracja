<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 04.01.17
 * Time: 13:40
 */


session_start();
error_reporting(E_ALL ^ E_NOTICE);

require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $array = [false, "Brak połączenia z bazą: " . mysqli_connect_error()];
    echo json_encode($array);
    exit();
}

$data = array_map('trim', $_POST);
$data = array_map('strip_tags', $_POST);

$kat = $data['kat'];
$nazwa = htmlentities($data['nazwa'], ENT_HTML5, "UTF-8");
$url = htmlentities($data['url'], ENT_HTML5, "UTF-8");
$cena = $data['cena'];


if (strlen($nazwa) == 0 || strlen($url) == 0 || strlen($cena) == 0) {
    $array = [false, "Nie uzupełniono wszystkich danych"];
    echo json_encode($array);
    exit();
}

if (!((substr($url, (strlen($url) - 3), 3)) == 'jpg') ||
    ((substr($url, (strlen($url) - 3), 3)) == 'png') ||
    ((substr($url, (strlen($url) - 4), 4)) == 'jpeg')
) {
    $array = [false, "URL obrazu jest nieprawidlowy. Końcówka musi się kończyć jpg, jpeg lub png"];
    echo json_encode($array);
    exit();
}

$chars = "1234567890,";
$good_sign = true;
$dot = 0;

for ($i = 0; $i < strlen($cena); $i++) {
    if ($cena[$i] == ',') {
        $dot++;
    }
    for ($j = 0; $j < strlen($chars); $j++) {
        if ($cena[$i] != $chars[$j]) {
            if ($j == strlen($chars) - 1) {
                $good_sign = false;
                break;
            }
        } elseif ($dot > 1) {
            $good_sign = false;
            break;
        } else {
            break;
        }
    }
    if (!$good_sign) {
        break;
    }
}

if (!$good_sign) {
    $array = [false, "Podana cena jest nieprawidłowa. Można używać jedynie cyfr oraz jednokrotnie znaku przecinka , " . $cena];
    echo json_encode($array);
    exit();
}

$cena = htmlentities($cena, ENT_HTML5, "UTF-8");


if (isset($_POST)) {

    $sql = sprintf("INSERT INTO `dania` (`id`, `kategoria`, `nazwa`, `url`, `cena`) 
        VALUES (NULL, '%s', '%s', '%s', '%s');",
        mysqli_real_escape_string($link, $kat),
        mysqli_real_escape_string($link, $nazwa),
        mysqli_real_escape_string($link, $url),
        mysqli_real_escape_string($link, $cena));

    //echo $sql;

    if ($result = mysqli_query($link, $sql)) {

        $array = [true, "Pomyślnie dodano danie"];
    } else {
        $array = [false, 'Nie dodano dania - błąd: ' . mysqli_error($link)];
    }
    mysqli_free_result($result);
    mysqli_close($link);

} else {
    $array = [false, 'Nie dodano dania - błąd: ' . mysqli_error($link)];
}

echo json_encode($array);



