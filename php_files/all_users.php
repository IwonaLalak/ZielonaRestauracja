<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 07.01.17
 * Time: 23:46
 */

header('Content-type: application/json');

require_once '../connect/db.php';
$pobrane_dane = array();

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $pobrane_dane[0] = ["Błąd: ", "nieudane połączenie z bazą danych"];
    echo json_encode($pobrane_dane);
    exit();
}

$sql = "SELECT id,login,grupa,rabat FROM users";


if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pobrane_dane[] = $row;
        }
    } else {
        $pobrane_dane[0] = ["Błąd: ", "brak rekordów do wyświetlenia"];

    }
    mysqli_free_result($result);
} else {
    $pobrane_dane[0] = ["Błąd: ", "nie można wyświetlić danych"];
}

mysqli_close($link);

echo json_encode($pobrane_dane);
