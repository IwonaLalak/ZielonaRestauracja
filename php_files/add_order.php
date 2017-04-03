<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 09.01.17
 * Time: 20:35
 */

session_start();

$_SESSION['zamow_error'] = false;

if (
    !(isset($_POST['imie'])) || (strlen($_POST['imie']) == 0) ||
    !(isset($_POST['nazwisko'])) || (strlen($_POST['nazwisko']) == 0) ||
    !(isset($_POST['telefon'])) || (strlen($_POST['telefon']) == 0) ||
    !(isset($_POST['adres'])) || (strlen($_POST['adres']) == 0)
) {

    $_SESSION['zamow_error'] = 'Uzupełnij poprawnie dane';
    header('Location: ../zamow.php');
    exit();
}
if (count($_POST['dania']) <= 0) {
    $_SESSION['zamow_error'] = 'Nie można złożyć pustego zamówienia';
    header('Location: ../zamow.php');
    exit();
}

$total = 0;
for ($i = 0; $i < count($_POST['ilosc']); $i++) {
    $total += $_POST['ilosc'][$i];
}

if ($total <= 0) {
    $_SESSION['zamow_error'] = 'Ilość konkretnego dania musi wynosić co najmniej 1 sztukę';
    header('Location: ../zamow.php');
    exit();
}

$imie = htmlentities($_POST['imie'], ENT_HTML5, "UTF-8");
$nazwisko = htmlentities($_POST['nazwisko'], ENT_HTML5, "UTF-8");
$telefon = htmlentities($_POST['telefon'], ENT_HTML5, "UTF-8");
$adres = htmlentities($_POST['adres'], ENT_HTML5, "UTF-8");
$info = htmlentities($_POST['info'], ENT_HTML5, "UTF-8");
$kwota = htmlentities($_POST['kwota'], ENT_HTML5, "UTF-8");

$ceny = array();
for ($i = 0; $i < count($_POST['ilosc']); $i++) {
    if ($_POST['ilosc'][$i] > 0) {
        array_push($ceny, $_POST['ilosc'][$i]);
    }
}
$zamowienie = "";
for ($i = 0; $i < count($_POST['dania']); $i++) {
    if ($i != count($_POST['dania']) - 1) {
        $zamowienie = $zamowienie . $_POST['dania'][$i] . ' | ' . $ceny[$i] . '<br>';
    } else {
        $zamowienie = $zamowienie . $_POST['dania'][$i] . ' | ' . $ceny[$i];
    }
}


require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $_SESSION['zamow_error'] = 'Brak połączenia z bazą: ' . mysqli_connect_error();
    header('Location: ../zamow.php');
    exit();
}

$sql = sprintf(("INSERT INTO `zamowienia` (`id`, `data`, `imie`, `nazwisko`, `adres`, `telefon`, `dodatkowe`, `dania`, `kwota`, `zrealizowane`) 
VALUES (NULL, CURRENT_TIMESTAMP, '%s', '%s', '%s', '%s', '%s', '%s', '%s', 'nie')"),
    mysqli_real_escape_string($link, $imie),
    mysqli_real_escape_string($link, $nazwisko),
    mysqli_real_escape_string($link, $adres),
    mysqli_real_escape_string($link, $telefon),
    mysqli_real_escape_string($link, $info),
    mysqli_real_escape_string($link, $zamowienie),
    mysqli_real_escape_string($link, $kwota));


if ($result = mysqli_query($link, $sql)) {
    $_SESSION['zamow_error'] = 'Twoje zamówienie zostało wysłane.';
    mysqli_free_result($result);
    header('Location: ../zamow.php');
} else {
    $_SESSION['zamow_error'] = 'Nie wysłano zamówienia - błąd: ' . mysqli_error($link);
    header('Location: ../zamow.php');
}
mysqli_close($link);