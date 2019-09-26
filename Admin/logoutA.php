<?php
session_start();
if (isset($_SESSION['log_user'])){
    unset($_SESSION['log_user']);
}
header("location:indexA.php")
?>