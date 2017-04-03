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
    echo '<li class="list-group-item">Brak połączenia z bazą: ' . mysqli_connect_error() . '</li>';
    exit();
}

$sql = "SELECT * FROM promocje";

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (strlen($row["tekst_mniejszy"]) >= 1) {
                $row["tekst_mniejszy"] = '<br /><small>' . $row["tekst_mniejszy"] . '</small>';
            }
            printf('
            
            <li class="list-group-item">
            '
                . $row["tekst_glowny"] .
                ' '
                . $row["tekst_mniejszy"] .
                '
                    </li>
            
            '
                , $row["tekst_glowny"], $row["tekst_mniejszy"]);
        }
    } else {
        echo '<li class="list-group-item">Brak obecnie promocji</li>';

    }
    mysqli_free_result($result);
} else {
    echo '<li class="list-group-item">Nie można wyświetlić danych</li>';
}

mysqli_close($link);
