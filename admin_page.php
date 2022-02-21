<?php 
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./class/admin_control_class.php');
include_once ('./includes/connection_includes.php');

    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);
    $investorId = $adminConnection -> checkId($connectionResult);

    if ($investorSession == true) {

        $adminControl = new AdminControlClass();

        if (isset($_POST['suspendId'])) {
            $adminControl -> suspendAccount($connectionResult);
        }

        if (isset($_POST['deleteId'])) {
            $adminControl -> deleteAccount($connectionResult);
        }

        if (isset($_POST['messageId'])) {
            $adminControl -> sendMessage($connectionResult);
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
            <a class="d-lg-none d-sm-none d-md-none text-left logout" href="./includesPages/admin_logout.php" style="text-decoration: none;">
                <p data-toggle="collapse" data-target="#navbarMenu">
                    Logout
                </p>
            </a>
            <?php 
                include_once ('./class/admin_account_class.php');
                include_once ('./includes/connection_includes.php');

                $admin = new AdminAccounClass();
                $investorId = $admin -> checkId($connectionResult);
            ?>
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
                    <?php
                        include_once ('./includes/connection_includes.php');
                        $queryAllInvestors = "SELECT `investors_id` FROM `investors` WHERE `suspendAccount` = '0' AND `deleteAccount` = '0'";
                        $runQueryAllInvestors = mysqli_query($connectionResult, $queryAllInvestors);
                        if ($runQueryAllInvestors) {
                            $totalInvestors = mysqli_num_rows($runQueryAllInvestors);
                        }
                    ?>
                    <div class="row">
                        <p class="col text-left" style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Total Active Investors:</p>
                        <p class="col text-right" style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;"><?php echo $totalInvestors;?></p>
                    </div>
                    <div class="row">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Here below are the new members or investors:</p>
                    </div>
                    <div class="row">
                        <table class="table" style="margin-left: 30px; margin-right: 30px;">
                            <tr style="background-color: #000000; color: #fff;">
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">ID</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Fullname</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Email Address</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Username</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Referral Link</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Email verification</td>
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
                                $selectInvestors = "SELECT `investors_id`, `fullname`, `investors_referral_link`, `is_email_verified`, `email_address`, `investor_username` FROM `investors` WHERE `suspendAccount` = '0' AND `deleteAccount` = '0' ORDER BY `investors_id` DESC";
                                $querySelectInvestors = mysqli_query($connectionResult, $selectInvestors);
                                if ($querySelectInvestors) {
                                    while ($a = mysqli_fetch_assoc($querySelectInvestors)) {
                                        $investorsId = $a['investors_id'];
                                        $investorsFullname = $a['fullname'];
                                        $link = $a['investors_referral_link'];
                                        $verified = $a['is_email_verified'];
                                        $emailAddress = $a['email_address'];
                                        $username = $a['investor_username'];

                                        if ($verified == 0) {
                                            $emailVerification = 'No';
                                        } else{
                                            $emailVerification = 'Yes';
                                        }
                                        $investorsLink = 'https://fortuneapex.com/register.php?investor='.$link;
                                        ?>
                                        <tr >
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $investorsId;?></td>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $investorsFullname;?></td>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $emailAddress;?></td>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $username;?></td>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $investorsLink;?></td>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $emailVerification;?></td>
                                            <?php
                                                if ($verified == 0) {
                                            ?>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">
                                                <form action="admin_page.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $link;?>" method="post" class="d-inline">
                                                    <input type="submit" value="Suspend" name="suspendId" class="btn" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 130px;">
                                                    <input type="submit" value="Delete" name="deleteId" class="btn" style="background-color: #dc3545; color: #fff; margin-bottom: 10px; width: 130px;">
                                                    <input type="submit" value="Message" name="messageId" class="btn" style="background-color: #ffa500; color: #fff; margin-bottom: 10px; width: 130px;">
                                                    <a class="btn" href="add_money.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $link;?>" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 130px;">Add Money</a>
                                                    <a class="btn" href="remove_money.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $link;?>" style="background-color: #ffa500; color: #fff; margin-bottom: 10px; width: 130px;">Remove Money</a>
                                                </form>
                                            </td>
                                            <?php
                                                } else{
                                            ?>
                                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">
                                                <form action="admin_page.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $link;?>" method="post" class="d-inline">
                                                    <input type="submit" value="Suspend" name="suspendId" class="btn" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 130px;">
                                                    <input type="submit" value="Delete" name="deleteId" class="btn" style="background-color: #dc3545; color: #fff; margin-bottom: 10px; width: 130px;">
                                                    <a class="btn" href="add_money.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $link;?>" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 130px;">Add Money</a>
                                                    <a class="btn" href="remove_money.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $link;?>" style="background-color: #ffa500; color: #fff; margin-bottom: 10px; width: 130px;">Remove Money</a>
                                                </form>
                                            </td>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                        <?php
                                        
                                        // if (isset($_POST['editId'])) {
                                        //     header('Location: edit_investor.php?investor='.$investorsId);
                                        // }

                                        // if (isset($_POST['addMoneyId'])) {
                                        //     header('Location: add_money.php?investor='.$investorsId);
                                        // }

                                        // if (isset($_POST['removeMoneyId'])) {
                                        //     header('Location: remove_money.php?investor='.$investorsId);
                                        // }
                                    }
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