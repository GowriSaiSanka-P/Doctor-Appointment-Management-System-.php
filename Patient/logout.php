<?php
session_start();
session_unset();
session_destroy();
header("Location: /dams/Patient/user_login.php");
exit;
?>