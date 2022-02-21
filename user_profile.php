<?php
session_start();

include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');
$investor = '';

$userAccount = new UserAccountClass();

    if ($userAccount->checkedSession($connectionResult) == true) {
        if ($_GET['investor']) {
            $investor = filter_var(trim(htmlspecialchars(htmlentities(mysqli_real_escape_string($connectionResult, $_GET['investor'])))), FILTER_SANITIZE_STRING);
        
            $username = $userAccount -> getUsername($connectionResult);
            $regDate = $userAccount -> getRegistrationDate($connectionResult);
            $status = $userAccount -> getstatus($connectionResult);
            $accountBalance = $userAccount -> getAccountBalance($connectionResult);
            $totalEarning = $userAccount -> getTotalEarning($connectionResult);
            $activeDeposit = $userAccount -> getActiveDeposit($connectionResult);
            $lastDeposit = $userAccount -> getLastDeposit($connectionResult);
            $totalWithdrawal = $userAccount -> getTotalWithdrawal($connectionResult);
            $pendingWithdrawl = $userAccount -> getPendingWithdrawal($connectionResult);
            $lastWithdrawal = $userAccount -> getLastWithdrawal($connectionResult);
            $investorCode = $userAccount -> getReferralCode($connectionResult);
            $referralCode = $userAccount -> investorLink($connectionResult);
            $noOfReferral = $userAccount -> getNoOfReferral($connectionResult);

            if ($status == 1) {
                $isOnline = 'Online';
            } else{
                $isOnline = 'Offline';
            }

            if (($accountBalance == null || '')) {
                $accountBalance = 0;
            } 

            if (($totalEarning == null || '')) {
                $totalEarning = 0;
            } 
            
            if (($activeDeposit == null || '')) {
                $activeDeposit = 0;
            } 
            
            if (($lastDeposit == null || '')) {
                $lastDeposit = 0;
            }
            
            if (($totalWithdrawal == null || '')) {
                $totalWithdrawal = 0;
            } 
            
            if (($pendingWithdrawl == null || '')) {
                $pendingWithdrawl = 0;
            }
            
            if (($lastWithdrawal == null || '')) {
                $lastWithdrawal = 0;
            }
        }
    } else{
        header('Location: login.php');
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
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage:'en'},
            'google_translate_element'
            );
        }
    </script>

    <title><?php echo $username;?></title>
    <script src="./copy_referral_link.js"></script>
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
            <a href="./user_dashboard.php?investor=<?php echo $investorCode;?>" class="d-lg-block d-sm-block d-md-block" style="text-align: right;">
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
                    <div id="google_translate_element" style="text-align: right;">
                    
                    </div>
                    <div class="row">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Account Area</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xl-3">
                            <img src="user/pictures/admin.png" alt="" class="rounded-circle" style="height: 150px; width: 150px;">
                        </div>
                        <div class="col" style="list-style-type: none;">
                            <li style="padding-bottom: 10px; height: 50px; text-transform: uppercase; font-weight: 700;">Username:</li>
                            <li style="padding-bottom: 10px; height: 50px; font-weight: 700; text-transform: uppercase;">Registration Date:</li>
                            <li style="padding-bottom: 10px; height: 50px; font-weight: 700; text-transform: uppercase;">Status:</li>
                            <li style="padding-bottom: 10px; height: 50px; font-weight: 700; text-transform: uppercase;">No Of Referral:</li>
                        </div>
                        <div class="col" style="list-style-type: none;">
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $username;?></li>
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $regDate;?></li>
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $isOnline;?></li>
                            <li style="padding-bottom: 10px; height: 50px;"><?php echo $noOfReferral;?></li>
                        </div>
                        <div class="col" style="list-style-type: none;">
                            <li style="padding-bottom: 15px; height: 70px;"><a class="btn" href="./make_deposit.php?investor=<?php echo $investor?>" style="border-color: #FFA500; background-color: #ffffff; color: #ffa500; border-radius: 30px; width: 200px;">New Deposit</a> </li>
                            <li style="padding-bottom: 15px; height: 70px;"><a class="btn" href="./withdraw_deposit.php?investor=<?php echo $investor?>" style="border-color: #FFA500; background-color: #ffffff; color: #ffa500; border-radius: 30px; width: 200px;">Withdraw Funds</a></li>
                        </div>
                    </div>
                    <hr style="background-color: #FFA500;">
                    <div class="row">
                        <div class="col text-center">
                            <img src="user/images/cash.jpg" alt="" style="height: 150px; border-radius: 20px;">
                            <p style="font-size: 18px;">Account Balance: $<?php echo $accountBalance;?></p>
                        </div>
                        <div class="col text-center">
                            <img src="user/images/cash.jpg" alt="" style="height: 150px; border-radius: 20px;">
                            <p style="font-size: 18px;">Total Earning: $<?php echo $totalEarning;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p class="col text-center" style="font-weight: 700; font-size: 18px;">Account History</p>
                    </div>
                    <div class="row">
                        <div class="col" style="background-color: #808080; margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <div class="row">
                                <div class="col">
                                    <p>Total Earning</p>
                                </div>
                                <div class="col">
                                    <p> $<?php echo $totalEarning;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>Active Deposit</p>
                                </div>
                                <div class="col">
                                    <p> $<?php echo $activeDeposit;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>Last Deposit</p>
                                </div>
                                <div class="col">
                                    <p> $<?php echo $lastDeposit;?></p>
                                </div>
                            </div>
                            
                        
                        </div>
                        <div class="col" style="background-color: #808080; margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <div class="row">
                                <div class="col">
                                    <p>Total Withdrawal</p>
                                </div>
                                <div class="col">
                                    <p> $<?php echo $totalWithdrawal;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>Pending Withdrawal</p>
                                </div>
                                <div class="col">
                                    <p> $<?php echo $pendingWithdrawl;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>Last Withdrawal</p>
                                </div>
                                <div class="col">
                                    <p> $<?php echo $lastWithdrawal;?></p>
                                </div>
                            </div>
                            
                        
                        </div>
                    </div>
                    <hr style="background-color: #808080;">
                    <div class="row" style="margin-top: 20px; height: 70px;">
                        <div class="col">
                            <P style="font-weight: 700; font-size: 18px;">Your Personal Referral Link:</P>
                        </div>
                        <div class="col" style="background-color: #ffa500; border-radius: 15px;">
                            <p class="text-left" style="font-weight: 700; font-size: 18px;"><input type="text" name="linkToCopyId" id="linkToCopyId" value="<?php echo $cryptoUrl.$referralCode;?>" style="height: 50px; width: 100%; border-color: #000; margin-top: 10px;" class="form-control" disabled></p>
                            <p class="text-right">
                                <button style="font-weight: 500; color: #ffffff; background-color: #000000; border-color: #000; border-radius: 5px; font-size: 16px; text-decoration: none;" onclick="copy()">Copy</button>
                            </p>
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