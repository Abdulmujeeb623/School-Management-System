<?php
session_start();
session_destroy();
header('Location: Crystalline_login.php');
exit();
?>
