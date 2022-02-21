<?php
session_start();
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

$userAccount = new UserAccountClass();

if ($userAccount -> checkedSession($connectionResult) == true) {
    $investorCode = $userAccount -> getReferralCode($connectionResult);
    $offline = 0;

    $updateStatus = "UPDATE `investors` SET `status` = '$offline' WHERE `investors_referral_link` = '$investorCode'";
    $queryUpdateStatus= mysqli_query($connectionResult, $updateStatus);

    if ($queryUpdateStatus) {
        session_destroy();
        header('Location: login.php');
    }
}else{
    header('Location: login.php');
}
?>

