<?php
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./class/pending_withdrawal_class.php');
include_once ('./includes/connection_includes.php');
    
    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);
    $investorId = $adminConnection -> checkId($connectionResult);

    if ($investorSession == true) {

        $pendingWithdrawal = new PendingWithdrawalClass();
        
        if (isset($_POST['approvedId'])) {
            $pendingWithdrawal -> approveWithdrawal($connectionResult);
        }

        if (isset($_POST['declinedId'])) {
            $pendingWithdrawal -> declineWithdrawal($connectionResult);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    
    <link rel="stylesheet" href="user/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="user/bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="user/css/logout.css">
    <!-- <link rel="stylesheet" href="user/bootstrap/css/admin_profile.css"> -->

    <link rel="icon" type="image/png" sizes="32x32" href="user/images/favicon.png">

    <title></title>
    <style>
        @media (min-width: 500px) {
            .col-sm-0{
            display: none;
            }
            .col-md-0{
                display: none;
            }   
        }
    </style>
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 60px;">
        <a class="navbar-brand" href="#" style="color: #fff;">Dashboard</a>
            <a class="d-lg-none d-sm-none d-md-none text-left logout" href="admin_logout.php" style="text-decoration: none;">
                <p data-toggle="collapse" data-target="#navbarMenu">
                    Logout
                </p>
            </a>
            <a href="admin_dashboard.php?admin=<?php echo $investorId;?>" class="d-lg-block d-sm-block d-md-block">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu" style="background-color: #FFA500;">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </a>
    </nav>

    <div>
        <div class="container-fluid">
            <div class="row" style="width: 100%; height: 1000px;">
                <div class="col-xl-4 col-sm-0 col-md-0" style="background-color: #000; border-color: #000; border: solid 1px;">
                    <div class="row">
                        <div class="container-fluid"  style="background-color: #000; width: 100%; height: 250px;">
                            <div class="text-center my-5">
                                <img src="user/pictures/admin.png" alt="admin.png" class="rounded-circle" style="color: #fff; margin-top: 20px;">
                            </div>
                            <div class="text-center">
                                <p style="color: #fff;">'.$name.'</p>
                            </div> 
                        </div> 
                    </div>
                    <div class="row">
                        <hr style="width: 100%; background-color: #FFA500;">
                    </div>
                    <div>
                        <ul class="list-group" style="background-color: #000; color: #fff;">
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="#" style="color: #FFA500; text-decoration: none;">New Investors</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="annoucement_upload.php" style="color: white; text-decoration: none;">Approved Deposit Amount</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="blog_upload.php" style="color: white; text-decoration: none;">Approved Withdrawal Amount</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Pending Withdraw Amount</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Pending Deposit Amount</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Admin Setting</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xl-12" style="margin-top: 70px;">
                    <div class="row">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Here below are the referrals and their inviters:</p>
                    </div>
                    <div class="row">
                        <table class="table" style="margin-left: 30px; margin-right: 30px;">
                            <tr style="background-color: #000000; color: #fff;">
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Investors Name</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Invitee Code</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Inviter Name</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Date of Registration</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Action</td>
                            </tr>
                            <?php
                                include_once ('./class/admin_account_class.php');
                                include_once ('./includes/connection_includes.php');
                                
                                $adminAccount = new AdminAccounClass();
                                $isIdTrue = $adminAccount -> checkId($connectionResult);

                                if ($isIdTrue == false) {
                                    echo 'wrong';
                            ?>
                            <?php
                            } else{
                                $selectReferral = "SELECT `inviter_referral`, `invitee_referral`, `date_registration` FROM `users_through_referrals`";
                                $querySelectReferral = mysqli_query($connectionResult, $selectReferral);
                                if ($querySelectReferral) {
                                    $numRows = mysqli_num_rows($querySelectReferral);
                                    if ($numRows == 0) {
                                        ?>
                                        </table>
                                            <div class="col-12 text-center">
                                                <p style="font-weight: 700; text-transform: uppercase;">Note: No Referral admin.</p>
                                            </div>
                                        <?php
                                    } else{
                                        while ($a = mysqli_fetch_assoc($querySelectReferral)) {
                                            $inviterReferral = $a['inviter_referral'];
                                            $inviteeReferral = $a['invitee_referral'];
                                            $dateRegistration = $a['date_registration'];

                                            $selectInviterName = "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$inviterReferral'";
                                            $querySelectInviterName = mysqli_query($connectionResult, $selectInviterName );

                                            if ($querySelectInviterName ) {
                                                while ($a = mysqli_fetch_assoc($querySelectInviterName )) {
                                                    $inviterName  = $a['fullname'];

                                                    $selectInviteeName = "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$inviteeReferral'";
                                                    $querySelectInviteeName = mysqli_query($connectionResult, $selectInviteeName );

                                                    if ($querySelectInviteeName ) {
                                                        while ($b = mysqli_fetch_assoc($querySelectInviteeName )) {
                                                            $inviteeName  = $b['fullname'];
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <tr >
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $inviteeName;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $inviteeReferral;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $inviterName;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $dateRegistration;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">
                                                <form action="pending_withdrawal.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $withdrawalInvestorCode;?>&withdrawalCode=<?php echo $withdrawalCode;?>" method="post" class="d-inline">
                                                    <input type="submit" value="Approve" name="approvedId" class="btn" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 100px;">
                                                    <input type="submit" value="Decline" name="declinedId" class="btn" style="background-color: #dc3545; color: #fff; margin-bottom: 10px; width: 100px;">
                                                </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else{
                                    echo 'error';
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="user/bootstrap/js/jquery.js" integrity="sha384q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
    <script src="user/bootstrap/js/popper.js"></script>
    <script src="user/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="user/bootstrap/js/bootstrap.js"></script>
</body>
</html>
<?php
    }else{
        header('Location: login.php');
    }
?>