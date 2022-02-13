<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie("Username", "", time()-3600);
    setcookie("Email", "", time()-3600);
    setcookie("UserUniqueID", "", time()-3600);
    header('location: ?login');
?>