<?php
include 'core/conf.php';
$isAdmin = false;
if (!isLogin()){
    header("location: login");
    exit;
}
//logout
destroySession();
header("location: dashboard");
?>