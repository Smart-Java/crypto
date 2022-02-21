<?php
session_start();
include_once ('./class/continue_deposit_class.php');
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

$plan = '';
$profit = '';
$principalWithdrawal = '';
$creditAccount = '';
$depositFee = '';
$debitAmount = '';

$paymentMeans = '';

$userAccount = new UserAccountClass();
$continuePayment = new ContinueDepositClass();

if ($userAccount -> checkedSession($connectionResult) == true) {
    $investorCode = $userAccount -> getReferralCode($connectionResult);
    $transactionCode = filter_var(trim(mysqli_real_escape_string($connectionResult, $_GET['transCode'])), FILTER_SANITIZE_STRING);
    $plan = $continuePayment -> getPlan($connectionResult);
    $profit = $continuePayment -> getProfit($connectionResult);
    $principalWithdrawal = $continuePayment -> getPricipalWithdrawal($connectionResult);
    $creditAccount = $continuePayment -> getCreditAccount($connectionResult);
    $depositFee = $continuePayment -> getDepositFee($connectionResult);
    $debitAmount = $continuePayment -> getDepositFee($connectionResult);

    $adminDepositWallet = $continuePayment -> getWallet($connectionResult);

    $name = $continuePayment -> getUserId($connectionResult);
    $transactionId = $continuePayment -> checkTransactionId($connectionResult);

    $investor = $continuePayment -> investorRef($connectionResult);

    $url = 'continue_deposit.php?investor='.$investor.'&transCode='.$transactionId;

    if (isset($_POST['saveTransactionId'])) {
        $transactionCode = filter_var(trim(mysqli_real_escape_string($connectionResult, $_GET['transCode'])), FILTER_SANITIZE_STRING);
        
        $transactionPin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['transId'])), FILTER_SANITIZE_STRING);
        $result = $continuePayment -> saveTransaction($connectionResult, $transactionPin);
    }

    if (isset($_POST['cancelTransactionId'])) {
        $transactionCode = filter_var(trim(mysqli_real_escape_string($connectionResult, $_GET['transCode'])), FILTER_SANITIZE_STRING); 
        
        $transactionPin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['transId'])), FILTER_SANITIZE_STRING);
        $result = $continuePayment -> cancelTransaction($connectionResult, $transactionPin);
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

    <title><?php echo $name;?></title>
    <script src="./copy_payment_address.js"></script>
    <style>
        .col-sm-0{
            display: none;
        }
        .col-md-0{
            display: none;
        }
    </style>
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 60px;">
        <a class="navbar-brand" href="#" style="color: #fff;"><?php echo $name ?></a>
            <a class="d-lg-none d-sm-none d-md-none text-left logout" href="admin_logout.php" style="text-decoration: none;">
                <p data-toggle="collapse" data-target="#navbarMenu">
                    Logout
                </p>
            </a>
            <a href="./user_dashboard.php?investor=<?php echo $investorCode;?>" class="d-lg-block d-sm-block d-md-block">
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
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="#" style="color: #FFA500; text-decoration: none;">Profile</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="annoucement_upload.php" style="color: white; text-decoration: none;">Account History</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="blog_upload.php" style="color: white; text-decoration: none;">Make Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Withdraw Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Account Settings</a></li>

                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-12 col-sm-12 col-md-12" style="margin-top: 70px;">
                    <div id="google_translate_element" style="text-align: right;">
            
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 5px; font-weight: 700; color:#000000;">Please confirm your deposit:</p>
                    </div>
                    <hr style="margin-top: 0px; background-color: #000;">
                    <div class="row">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 5px; font-weight: normal; color:#000000;">Send the payment to the company's address below</p>
                    </div>
                    <div class="row" style="background-color: #808080; border-radius: 15px; width: 100%; height: 120px; margin-left: 15px;">
                        <div class="col" style="background-color: #ffa500; border-radius: 15px;">
                            <p class="text-left" style="font-weight: 700; font-size: 18px;"><input type="text" name="linkToCopyId" id="linkToCopyId" value="<?php echo $adminDepositWallet;?>" style="height: 50px; width: 100%; border-color: #000; margin-top: 10px;" class="form-control" disabled></p>
                            <p class="text-right">
                                <button style="font-weight: 500; color: #ffffff; background-color: #000000; border-color: #000; border-radius: 5px; font-size: 16px; text-decoration: none;" onclick="copy()">Copy</button>
                            </p>
                        </div>
                    </div>

                    <div class="row"  style="text-align: center; margin-top: 15px;">
                        <div class="col" style="margin-right: 15px; margin-left: 15px; border-radius: 15px;">
                            <table>
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff; padding-left: 50px;">Plan</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; padding-left: 50px;"><?php echo $plan;?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff; padding-left: 50px;">Profit</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; padding-left: 50px;"><?php echo $profit;?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff; padding-left: 50px;">Prinicpal Withdraw</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; padding-left: 50px;"><?php echo $principalWithdrawal;?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff; padding-left: 50px;">Credit Account</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; padding-left: 50px;"><?php echo $creditAccount;?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff; padding-left: 50px;">Deposit Fee</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; padding-left: 50px;"><?php echo '$'.$depositFee;?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff; padding-left: 50px;">Debit Amount</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; padding-left: 50px;"><?php echo '$'.$debitAmount;?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="row" style="margin-bottom: 10px;">
                            <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 5px; font-weight: 700; color:#000000;">Required Information:</p>
                        </div>
                        <div class="row" style="margin-bottom: 0px;">
                            <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 5px; font-weight: 700; color:#000000;">Required Information:</p>
                        </div>
                    </div>
                    <form action="<?php echo $url;?>" method="post" class="row"><br>
                        <div class="input-group form-group">
                            <input type="text" name="usernameId" id="usernameId" class="form-control" style="border-color: #000; margin-left: 10px;" value="<?php echo $name;?>" placeholder="Username" disabled> 
                        </div>
            
                        <div class="input-group form-group">
                            <input type="text" name="transactionId" id="transactionId" class="form-control" style="border-color: #000; margin-left: 10px;" value="<?php echo $transactionId;?>" placeholder="Transaction ID" disabled> 
                        </div>
                        <div class="input-group form-group">
                            <input type="text" name="transId" id="transId" class="form-control" style="border-color: #000; margin-left: 10px;" value="" placeholder="Transaction ID"> 
                        </div>
                        <div class="row d-inline" style="margin-left: 15px; margin-bottom: 30px;">
                            <div class="col">
                                <input type="submit" name="saveTransactionId" value="Save" style="width: 150px; <?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder;?>; border-color: #ffa500;">
                                <input type="submit" name="cancelTransactionId" value="Cancel" style="width: 150px; <?php include_once('./includesPages/style.php'); echo $btnWhiteTxtOrangeBorder?>; border-color: #ffa500;">
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div id="google_translate_element">
            
    </div>
    
    <script src="user/bootstrap/js/jquery.js" integrity="sha384q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
    <script src="user/bootstrap/js/popper.js"></script>
    <script src="user/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="user/bootstrap/js/bootstrap.js"></script>
</body>
</html>
<?php 
} else{
    header('Location: login.php');
}
?>