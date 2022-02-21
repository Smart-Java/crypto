<?php
session_start();
include_once ('./class/withdraw_deposit_class.php');
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

$investorAccount = new UserAccountClass();

$comment = '';
$amount = '';
$information = '';

if ($investorAccount -> checkedSession($connectionResult) == true) {
    $accountBalance = $investorAccount -> getAccountBalance($connectionResult);
    $pendingWithdrawal = $investorAccount -> getPendingWithdrawal($connectionResult);
    $username = $investorAccount -> getUsername($connectionResult);
    $investorCode = $investorAccount -> getReferralCode($connectionResult);

    if (($accountBalance == null || '')) {
        $accountBalance = 0;
    } 

    if (($pendingWithdrawal == null || '')) {
        $pendingWithdrawal = 0;
    } 
    $b = $investorAccount -> getUSDTCash($connectionResult);
    if ($b == null || $b == '') {
        // echo '0';
    }
    $url = 'withdraw_deposit.php?investor='.$investorAccount->getReferralCode($connectionResult);
    

    if (isset($_POST['amountToWithdrawId']) && isset($_POST['commentWithdrawalId']) && isset($_POST['selectWalletId'])) {
        $account = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['amountToWithdrawId'])), FILTER_SANITIZE_STRING);
        $comment = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['commentWithdrawalId'])), FILTER_SANITIZE_STRING);
        $meansToWithdraw = $_POST['selectWalletId'];
        
        if (!empty($comment) && !empty($account) && !empty($meansToWithdraw)) {
            $withdrawDeposit = new WithdrawDepositClass($account, $comment, $meansToWithdraw);
            
            $isItTrue = $withdrawDeposit->checkDate($connectionResult);
            if ($isItTrue == true) {
                $result = $withdrawDeposit -> performInsertWithdrawal($connectionResult);
                $information = 'Note: '.$result;
            } else{
                $information = 'Note: You can withdraw in next 24 to 36 hrs';
            }
            
            
        } else{
            echo 'You can\'t withdraw anonymously investor';
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

    <title><?php echo $username;?></title>
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
                
                <div class="col-xl-12 col-sm-12 col-md-12" style="margin-top: 70px;">
                    <div id="google_translate_element" style="text-align: right;">
                    
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 70px; margin-left: 15px; margin-right: 15px; margin-bottom: 15px;">
                            <div class="row">
                                <p class="ml-3 mt-3 text-left">Account Balance</p>
                                <p class="ml-5 mt-3 text-right"><?php echo '$'.$accountBalance;?></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 70px; margin-left: 15px; margin-right: 15px; margin-bottom: 15px;">
                            <div class="row">
                                <p class="ml-3 mt-3">Pending Withdrawals</p>
                                <p class="ml-5 mt-3"><?php echo '$'.$pendingWithdrawal;?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="row" style="margin-bottom: 10px;">
                            <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 5px; font-weight: 700; color:#000000;">Withdrawal($)</p>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                            <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 5px; font-weight: 700; color:#000000;"><?php echo $information;?></p>
                        </div>
                    </div>
                    <hr style="background-color: #000; height: 1.5; margin-top:0px;">
                    <form action="<?php echo $url;?>" method="post" class="row"><br>
                        <div class="input-group form-group">
                            <p style="margin-left: 10px;">Select wallet to Withdraw from:</p>
                            <select name="selectWalletId" id="selectWalletId" class="form-control" style="border-color: #000; margin-left: 10px;">
                                <option value="Bitcoin">Bitcoin</option>
                                <option value="Litecoin">Litecoin</option>
                                <option value="Ethereum">Ethereum</option>
                                <option value="USDT">USDT</option>
                                <option value="Bitcoin Cash">Bitcoin Cash</option>
                            </select>
                        </div>
                        <div class="input-group form-group">
                            <input type="text" name="amountToWithdrawId" id="amountToWithdrawId" class="form-control" style="border-color: #000; margin-left: 10px;" value="<?php $amount?>" placeholder="Amount($)"> 
                        </div>
            
                        <div class="input-group form-group">
                            <textarea name="commentWithdrawalId" id="commentWithdrawalId" cols="30" rows="5" class="form-control" style="border-color: #000; margin-left: 10px;"></textarea>
                        </div>
                        <div class="row" style="margin-left: 15px;">
                            <div class="col">
                                <input type="submit" value="Request" style="width: 150px; <?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder;?>; border-color: #ffa500;">
                            </div>
                        </div>
                    </form>
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