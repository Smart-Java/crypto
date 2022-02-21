<?php
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./includes/connection_includes.php');

    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);

if ($investorSession == true) {
    $investorId = $adminConnection -> checkId($connectionResult);
    $offline = 0;

    $updateStatus = "UPDATE `special_login` SET `status` = '$offline' WHERE `code` = '$investorId'";
    $queryUpdateStatus= mysqli_query($connectionResult, $updateStatus);

    if ($queryUpdateStatus) {
        session_destroy();
        header('Location: special_login.php');
    }
}else{
    header('Location: login.php');
}
?>

