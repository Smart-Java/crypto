<?php
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./class/pending_deposit_class.php');
include_once ('./includes/connection_includes.php');
    
    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);
    $investorId = $adminConnection -> checkId($connectionResult);

    if ($investorSession == true) {
        $pendingDeposit = $adminConnection -> getPendingDeposit($connectionResult);
        $approvedDeposit = $adminConnection -> getApprovedDeposit($connectionResult);
        $pendingWithdrawal = $adminConnection -> getPendingWithdrawal($connectionResult);
        $approvedWithdrawal = $adminConnection -> getApprovedWithdrawal($connectionResult);

        $username = $adminConnection -> getName($connectionResult);
        $pin = $adminConnection -> getPin($connectionResult);
        $status = $adminConnection -> getStatus($connectionResult);

        if ($status == '1') {
            $isOnline = 'Online';
        } else{
            $isOnline = 'Offline';
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
    
    <title><?php echo $username;?></title>

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
        <a class="navbar-brand" href="#" style="color: #fff;">Welcome <?php echo $username;?></a>
            <a href="./admin_dashboard.php?admin=<?php echo $investorId;?>" class="d-lg-block d-sm-block d-md-block" style="text-align: right;">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu" style="background-color: #FFA500;">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </a>
    </nav>

    <div>
        <div class="container-fluid">
            <div class="row" style="width: 100%; height: 1000px;">
                <!-- <div class="col-sm-0" style="background-color: #000; border-color: #000; border: solid 1px;">
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
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="#" style="color: #FFA500; text-decoration: none;">Profile</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="annoucement_upload.php" style="color: white; text-decoration: none;">Account History</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="blog_upload.php" style="color: white; text-decoration: none;">Make Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Withdraw Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Account Settings</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Notifications</a></li>
                        </ul>
                    </div>
                </div> -->
                
                <div class="col-md-12 col-sm-12 col-xl-12" style="margin-top: 70px;">
                    <div class="row">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Account Area</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xl-3">
                            <img src="user/pictures/admin.png" alt="" class="rounded-circle" style="height: 150px; width: 150px;">
                        </div>
                        <div class="col" style="list-style-type: none;">
                            <li style="padding-bottom: 10px; height: 50px; text-transform: uppercase; font-weight: 700;">Username:</li>
                            <li style="padding-bottom: 10px; height: 50px; font-weight: 700; text-transform: uppercase;">Pin:</li>
                            <li style="padding-bottom: 10px; height: 50px; font-weight: 700; text-transform: uppercase;">Status:</li>
                        </div>
                        <div class="col" style="list-style-type: none;">
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $username;?></li>
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $pin;?></li>
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $isOnline;?></li>
                        </div>
                        <div class="col" style="list-style-type: none;">
                            <li style="padding-bottom: 15px; height: 70px;"><a class="btn" href="./pending_deposit.php?admin=<?php echo $investorId?>" style="border-color: #FFA500; background-color: #ffffff; color: #ffa500; border-radius: 30px; width: 200px;">Pending Deposit</a> </li>
                            <li style="padding-bottom: 15px; height: 70px;"><a class="btn" href="./pending_withdrawal.php?admin=<?php echo $investorId?>" style="border-color: #FFA500; background-color: #ffffff; color: #ffa500; border-radius: 30px; width: 200px;">Pending Withdrawal</a></li>
                        </div>
                    </div>
                    <hr style="background-color: #FFA500;">
                    <div class="row">
                        <p class="col text-center" style="font-weight: 700; font-size: 18px;">Investors History</p>
                    </div>
                    <div class="row">
                        <div class="col" style="background-color: #808080; margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; padding: 20px; text-transform: upperxase;">Pending Deposits</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; text-transform: upperxase;"> <?php echo $pendingDeposit;?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col" style="background-color: #808080; margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; padding: 20px; text-transform: upperxase;">Pending Withdrawal</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; text-transform: upperxase;"> <?php echo $pendingWithdrawal;?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col" style="background-color: #808080; margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; padding: 20px; text-transform: upperxase;">Approved Deposit</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700;  text-transform: upperxase;"> <?php echo $approvedDeposit;?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="background-color: #808080; margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; padding: 20px; text-transform: upperxase;">Approved Withdrawal</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <p style="font-weight: 700; text-transform: upperxase;"> <?php echo $approvedWithdrawal;?></p>
                                </div>
                            </div>
                        </div>
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