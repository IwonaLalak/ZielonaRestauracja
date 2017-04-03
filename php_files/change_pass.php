<?php

session_start();
$_SESSION['password_change_error'] = false;

if (!(isset($_POST['nowe'])) ||
    (strlen($_POST['nowe']) < 3) ||
    (strlen($_POST['nowe']) > 30)
) {
    $_SESSION['password_change_error'] = 'Nowe hasło musi się mieścić w zakresie 3 - 30 znaków';
    header('Location: ../profil.php');
    exit();
}
$obecne = md5(htmlentities($_POST['obecne'], ENT_HTML5, "UTF-8"));
$nowe = md5(htmlentities($_POST['nowe'], ENT_HTML5, "UTF-8"));


require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $_SESSION['password_change_error'] = 'Brak połączenia z bazą: ' . mysqli_connect_error();
    header('Location: ../profil.php');
    exit();
}

$sql = sprintf("SELECT id FROM users WHERE password='%s'",
    mysqli_real_escape_string($link, $obecne));

if ($result = mysqli_query($link, $sql)) {

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            mysqli_free_result($result);
            $sql = sprintf("UPDATE `users` SET `password` = '%s' WHERE `users`.`id` = " . $row["id"],
                mysqli_real_escape_string($link, $nowe));
            if ($result = mysqli_query($link, $sql)) {
                $_SESSION['password_change_error'] = 'Zaktualizowano hasło';
            }
            break;
        }

        mysqli_free_result($result);
        header('Location: ../profil.php');
    } else {
        $_SESSION['password_change_error'] = 'Obecne hasło jest nieprawidłowe';
        header('Location: ../profil.php');
    }


} else {
    $_SESSION['password_change_error'] = 'Wystąpił błąd: ' . mysqli_error($link);
    header('Location: ../profil.php');
}

mysqli_close($link);