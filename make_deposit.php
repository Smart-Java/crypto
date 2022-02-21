<?php
session_start();
include_once ('./class/make_deposit_class.php');
include_once ('./class/user_account_class.php');
include_once ('./class/continue_deposit_class.php');
include_once ('./includes/connection_includes.php');

$amountToDeposit = '';
$information = '';
$userAccount = new UserAccountClass();
$continuePayment = new ContinueDepositClass();

if ($userAccount -> checkedSession($connectionResult) == true) {
    $userName = $userAccount-> getUsername($connectionResult);
    $userAccountBalance = $userAccount -> getAccountBalance($connectionResult);
    $investor = $userAccount -> getReferralCode($connectionResult);

    if ($userAccountBalance == null || $userAccountBalance == '') {
        $userAccountBalance = 0;
    }
    $investorCode = $userAccount -> getReferralCode($connectionResult);
    
    if (isset($_POST['submitTransactId'])) {
        if (isset($_POST['planId']) && isset($_POST['depositAmountId']) && isset($_POST['MethodId'])) {
            if (!empty($_POST['planId']) && !empty($_POST['depositAmountId']) && !empty($_POST['MethodId'])) {
                $plan = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['planId'])), FILTER_SANITIZE_STRING);
                $amountToDeposit = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['depositAmountId'])), FILTER_SANITIZE_STRING);
                $methodToPay = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['MethodId'])), FILTER_SANITIZE_STRING);
                // echo $amountToDeposit;
                // if ($amountToDeposit == 0) {
                //     echo $amountToDeposit;
                //     $information = 'Amount is less than the starter plan';
                // } else 
                if($amountToDeposit >= 50){
                    if ($plan == 'Stage 1') {
                        if ($amountToDeposit <= 4999) {
                            $makeDeposit = new MakeDepositClass($amountToDeposit, $plan, $methodToPay);
                
                            $result = $makeDeposit -> uploadDeposit($connectionResult);
                            $information = 'Note: '.$result;
                        } else{
                            $information = 'Amount is less than the starter plan';
                        }
                    } else if ($plan == 'Stage 2') {
                        if ($amountToDeposit >= 5000) {
                            $makeDeposit = new MakeDepositClass($amountToDeposit, $plan, $methodToPay);
                
                            $result = $makeDeposit -> uploadDeposit($connectionResult);
                            $information = 'Note: '.$result;
                        } else{
                            $information = 'Amount is less than the premium plan';
                        }
                    }
                } else{
                    $information = 'Amount is less than the starter plan';
                }
                // $makeDeposit = new MakeDepositClass($amountToDeposit, $plan, $methodToPay);
                
                // $result = $makeDeposit -> uploadDeposit($connectionResult);
                // $information = 'Note: '.$result;
            }
        }
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
    

    <title><?php echo $userName;?></title>
    <style>
        .col-sm-0{
            display: none;
        }
        .col-md-0{
            display: none;
        }
    </style>

    <script src="./make_deposit.js"></script>
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 60px;">
        <a class="navbar-brand" href="#" style="color: #fff;">Dashboard</a>
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
                
                <div class="col-xl-12 col-sm-12 col-md-12 text-center" style="margin-top: 70px;">
                <div id="google_translate_element" style="text-align: right;">
            
                </div>    
                <div class="row">
                        <p style="text-transform: capitalize; font-weight: bold; margin-left: 10px;">Select A Plan</p>
                    </div>
                    <div class="row" style="margin-top: 0.5px;">
                        <p style="text-transform: capitalize; font-weight: bold; margin-left: 10px;"><?php $information;?></p>
                    </div>
                    <hr style="margin-top: 0px; background-color: #000;">
                    <div class="container" style="text-align: center;">
                        <div class="row">
                            <div class="col-xl-5 col-md-12 col-sm-12 text-center" style="background-color: #808080; border-radius: 20px; margin-left: 15px; margin-right: 40px; margin-top: 15px;">
                                <p style="font-weight: bold;">STARTER PLAN</p>
                                <p style="font-weight: 500;">3% AFTER 24HOURS</p>
                                <hr style="background-color: #FFA500; height: 1.5px;">
                                <p style="font-weight: bold; font-size: 18px;">min Deposit: <small style="font-weight: 500;" id="stage1AmountId">$50</small></p>
                                <p style="font-weight: bold; font-size: 18px;">max Deposit: <small style="font-weight: 500;"> $4999</small></p>
                                <p style="font-weight: 500;">10% Referral Commission</p>
                                <p>
                                <input type="checkbox" name="checkStage1Id" id="checkStage1Id" style="margin-right: 0px;" onclick="attachAmountStage1()">
                                <label>Select</label>
                                </p>
                            </div>
                            <div class="col-xl-5 col-md-12 col-sm-12 text-center" style="background-color: #808080; border-radius: 20px; margin-left: 15px; margin-right: 40px; margin-top: 15px;">
                                <p style="font-weight: bold;">PRO PLAN</p>
                                <p style="font-weight: 500;">7% AFTER 36HOURS</p>
                                <hr style="background-color: #FFA500; height: 1.5px;">
                                <p style="font-weight: bold; font-size: 18px;">min Deposit: <small style="font-weight: 500;" id="stage2AmountId">$5000</small></p>
                                <p style="font-weight: bold; font-size: 18px;">max Deposit: <small style="font-weight: 500;"> Unlimited</small></p>
                                <p style="font-weight: 500;">10% Referral Commission</p>
                                <p>
                                <input type="checkbox" name="checkStage2Id" id="checkStage2Id" style="margin-right: 0px;" onclick="attachAmountStage2()">
                                <label>Select</label>
                                </p>
                            </div>
                        </div>
                        <div class="row" style="margin: 15px;">
                            <div class="col">
                                <input type="radio" name="btcId" id="btcId" onclick="transWithBitCoin()">
                                <label for="btcId">Bitcoin</label>
                            </div>
                            <div class="col">
                                <input type="radio" name="btcId" id="liteId" onclick="transWithLiteCoin()">
                                <label for="liteId">Litecoin</label>
                            </div>
                            <div class="col">
                                <input type="radio" name="btcId" id="usId" onclick="transWithUsdt()">
                                <label for="usId">USDT</label>
                            </div>
                            <div class="col">
                                <input type="radio" name="btcId" id="ethereumId" onclick="transWithEthereum()">
                                <label for="ethereumId">Ethereum</label>
                            </div> 
                            <div class="col">
                                <input type="radio" name="btcId" id="btcCashId" onclick="transWithBitcoinCash()">
                                <label for="btcCashId">Bitcoin Cash</label>
                            </div>                            
                        </div>
                    </div>
                    <div class="row col-xl-12 col-sm-12 col-md-12" style="margin-top: 30px; background-color: #000; border-radius: 10px; margin-left: 10px; color: #fff; height: 100px;">
                        <p style="padding-top: 40px; padding-left: 40px;">Your Account Balance: <small id="balancedAmountId"><?php echo '$'.$userAccountBalance;?></small></p>
                    </div>
                    <div class="row mt-3">
                        <p style="text-transform: capitalize; font-weight: bold; margin-left: 10px;" id="paymentOverviewId">Overview of payment:</p>
                        <br><p style="text-transform: capitalize; font-weight: bold; margin-left: 10px;"><?php echo $information;?></p>
                    </div>
                    <hr style=" margin-top: 0px; background-color: #000;">
                   <form action="make_deposit.php?investor=<?php echo $investor;?>" method="post">
                    <div class="row" style="margin: 10px;">
                        <label for="planId">Selected Plan:</label>
                        <input type="text" name="planId" id="planId" style="border-radius: 5px; border-color: #000; width: 50%; margin-left: 20px; padding-left: 10px;" >
                    </div>
                    <div class="row" style="margin: 10px;">
                        <label for="MethodId">Selected Method:</label>
                        <input type="text" name="MethodId" id="MethodId" style="border-radius: 5px; border-color: #000; width: 50%; margin-left: 20px; padding-left: 10px;" >
                    </div>
                   <div class="row" style="margin: 10px;">
                        <label for="depositAmount">Deposit Amount:</label>
                        <input type="number" name="depositAmountId" id="depositAmountId" style="border-radius: 5px; border-color: #000; width: 50%; margin-left: 20px; padding-left: 10px;" >
                    </div>
                    <p class="text-right">
                        <input type="submit" value="Spend" style="border-radius: 10px; color: #fff; border-color: #000; background-color: #000;" name="submitTransactId">
                    </p>
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
}else{
    header('Location: login.php');
}
?>