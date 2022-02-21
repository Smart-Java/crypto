<?php
ob_flush();
session_destroy();
include_once ('../includes/connection_includes.php');

if (isset($_GET['investor']) && !empty($_GET['investor'])) {
    $investorRef = filter_var(trim(htmlspecialchars(htmlentities(mysqli_real_escape_string($connectionResult, $_GET['investor'])))), FILTER_SANITIZE_STRING);

    $checkInvestor = "SELECT `investors_referral_link` FROM `investors` WHERE `investors_referral_link` = '$investorRef'";
    $queryCheckInvestor = mysqli_query($connectionResult, $checkInvestor);

    if ($queryCheckInvestor) {
        $numRows = mysqli_num_rows($queryCheckInvestor);
        if ($numRows == 1) {
            while ($a = mysqli_fetch_assoc($queryCheckInvestor)) {
                $referral = $a['investors_referral_link'];
            }
            $updateStatus = "UPDATE `investors` SET `status` = '0' WHERE `investors_referral_link` = '$referral'";
            $queryUpdateStatus = mysqli_query($connectionResult, $updateStatus);
            if ($queryUpdateStatus) {
                header("Location: ../login.php");
            }
        }
    }
} else{
    header("Location: ../login.php");
}
?>