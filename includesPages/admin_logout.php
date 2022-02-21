<?php
session_destroy();

if (isset($_GET['admin'])) {
    $adminRef = filter_var(trim(htmlspecialchars(htmlentities(mysqli_real_escape_string($connectionResult, $_GET['admin'])))), FILTER_SANITIZE_STRING);

    $checkAdmin = "SELECT `code` FROM `special_login` WHERE `code` = '$adminRef'";
    $queryCheckAdmin = mysqli_query($connectionResult, $checkAdmin);

    if ($queryCheckAdmin) {
        $numRows = mysqli_num_rows($queryCheckAdmin);
        if ($numRows == 1) {
            while ($a = mysqli_fetch_assoc($queryCheckAdmin)) {
                $referral = $a['code'];
            }
            $updateStatus = "UPDATE `admin` SET `status` = '0' WHERE `code` = '$referral'";
            $queryUpdateStatus = mysqli_query($connectionResult, $updateStatus);
            if ($queryUpdateStatus) {
                header("Location: ../special_login.php");
            }
        }
    }
} else{
    header("Location: ../special_login.php");
}
?>