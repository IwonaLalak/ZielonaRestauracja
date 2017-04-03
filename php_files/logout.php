<?php
/**
 * Created by IntelliJ IDEA.
 * User: Iwona
 * Date: 07.01.17
 * Time: 18:22
 */

session_start();
session_destroy();
header('Location: ../index.php');
exit();