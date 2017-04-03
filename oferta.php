<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 06.01.17
 * Time: 22:03
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aplikacje internetowe - Projekt 2</title>
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/import.css">
</head>
<body id="oferta_page">
<?php
require_once 'navbar/navbar.php';
?>
<div id="bottom_header"></div>
<div id="wrapper">
    <div class="container">


        <?php
        require_once 'php_files/all_food_oferta.php';
        ?>

        <!-- SPACE -->
        <div style="height:30px;"></div>

    </div>
</div>

<?php
require_once 'footer/footer.php';
require_once 'modal/modal.php';
?>
</body>
</html>
<script src="resources/jQuery/jQuery.js"></script>
<script src="resources/bootstrap/js/bootstrap.js"></script>
