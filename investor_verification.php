<?php
include_once ('./includes/connection_includes.php');


if (isset($_GET['investor'])) {
    $investorCode = filter_var(trim(htmlspecialchars(htmlentities(mysqli_real_escape_string($connectionResult, $_GET['investor'])))), FILTER_SANITIZE_STRING);

    $checkInvestorCode = "SELECT `investors_id` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
    $queryCheckInvestorCode = mysqli_query($connectionResult, $checkInvestorCode);

    if ($queryCheckInvestorCode) {
        $num_rows = mysqli_num_rows($queryCheckInvestorCode);

        if ($num_rows == 0) {
            header('Location: register.php');
        } else{
            $verified = 1;

            $updateStatus = "UPDATE `investors` SET `is_email_verified` = '$verified' WHERE `investors_referral_link` = '$investorCode'";
            $queryUpdateStatus= mysqli_query($connectionResult, $updateStatus);

            if ($queryUpdateStatus) {
                header('Location: login.php');
            }
        }
    } else{
        header('Location: register.php');
    }
} else{
    header('Location: register.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="shortcut icon" href="images/backgrounds/favicon.png">
    <title>Investor Verification</title>
</head>
<body>
    
</body>
</html>