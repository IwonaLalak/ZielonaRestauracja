<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 04.01.17
 * Time: 13:40
 */
session_start();

$_SESSION['forget_error'] = false;
$_SESSION['zalogowany'] = false;

if (!(isset($_POST['user_email'])) ||
    (strlen($_POST['user_email']) < 3) || (strlen($_POST['user_email']) > 50)
) {
    $_SESSION['forget_error'] = 'Login / hasło / email muszą się mieścić w zakresie 3 - 30 (email: 50) znaków';
    header('Location: ../forget.php');
    exit();
}

$email = $_POST['user_email'];

require_once '../connect/db.php';

$link = mysqli_connect("localhost", $db_user, $db_password, "restauracja");

if (mysqli_connect_errno()) {
    $_SESSION['forget_error'] = 'Brak połączenia z bazą: ' . mysqli_connect_error();
    header('Location: ../forget.php');
    exit();
}


$sql = sprintf("SELECT password FROM users WHERE email='%s'",
    mysqli_real_escape_string($link, $email));

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $pass = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $pass = $row["password"];
            break;
        }

        $headers = 'From: NADAWCA' . "\r\n" .
            'Reply-To: NADAWCA' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $to = '' . $email . '';
        $subject = 'Przypomnienie hasla';
        $message = 'Twoje haslo to: ' . $pass;
        mail($to, $subject, $message, $headers);

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['forget_error'] = 'Wysłano email';
        } else {
            $_SESSION['forget_error'] = 'Wystąpił błąd podczas wysyłania email';
        }
        // tu wyslanie mejla


    } else {
        $_SESSION['forget_error'] = 'Nie ma takiego emaila w bazie';

    }
    mysqli_free_result($result);
    header('Location: ../forget.php');
} else {
    $_SESSION['forget_error'] = 'Wystąpił błąd: ' . mysqli_error($link);
    header('Location: ../forget.php');
}

mysqli_close($link);
