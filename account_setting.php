<?php
session_start();
include_once ('./class/account_setting_class.php');
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

$bitcoin = '';
$litecoin = '';
$ethereumCoin = '';
$usdtCoin = '';
$information= '';

$investorAccount = new UserAccountClass();

if ($investorAccount -> checkedSession($connectionResult) == true) {
    $investorName = $investorAccount -> getUsername($connectionResult);
    $investorEmail = $investorAccount -> getUserEmail($connectionResult);
    $investorLink = $investorAccount -> investorLink($connectionResult);
    $investorCode = $investorAccount -> getReferralCode($connectionResult);

    $link = $cryptoUrl.$investorLink;

    $url = 'account_setting.php?investor='.$investorAccount ->getReferralCode($connectionResult);

    if (isset($_POST['bitcoinId']) && isset($_POST['litecoinId']) && isset($_POST['ethereumCoinId']) && isset($_POST['usdtCoinId']) && isset($_POST['btcCashId'])) {
        $bitcoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['bitcoinId'])), FILTER_SANITIZE_STRING);
        $litecoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['litecoinId'])), FILTER_SANITIZE_STRING);
        $usdtCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['usdtCoinId'])), FILTER_SANITIZE_STRING);
        $ethereumCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['ethereumCoinId'])), FILTER_SANITIZE_STRING);
        $btcCash = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['btcCashId'])), FILTER_SANITIZE_STRING);

        $investorAccountSetting = new AccountSettingClass($bitcoin, $litecoin, $ethereumCoin, $usdtCoin, $btcCash);
        $result = $investorAccountSetting -> updateInvestorRecord($connectionResult);

        $information = 'Note: '.$result;
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

    <title><?php $investorName?></title>
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
            <!-- <a class="d-lg-block d-sm-none d-md-none text-left logout" href="admin_logout.php" style="text-decoration: none;">
                <p data-toggle="collapse" data-target="#navbarMenu">
                    Logout
                </p>
            </a> -->
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
                        <p class="text-left ml-4 mb-3" style="text-transform: Uppercase; font-weight: bold;"> Edit Account</p>
                    </div>
                    <div class="row">
                        <p class="text-left ml-4" style="text-transform: Uppercase; font-weight: normal;"> Profile Information</p>
                        <p class="text-left ml-4" style="text-transform: Uppercase; font-weight: normal; margin-top:0px; color: #ffa500;"> <?php echo $information;?></p>
                    </div>
                    <hr style="background-color: #000; height: 1.5; margin-top:0px;">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 50%; margin-left: 15px;">
                            <form class="row d-inline" method="post" action="<?php echo $url;?>">
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px; font-weight: 700; text-transform: uppercase;">Note: Update of wallets is done one after the other for now, soon it will be rectify.</p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Fullname: </p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $investorName;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Email Address:</p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $investorEmail;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Referral Link: </p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $link;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="bitcoinId" style="margin-right: 50px;">BTC Wallet: </label></p>
                                    <input type="text" name="bitcoinId" id="bitcoinId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="litecoinId" style="margin-right: 50px;">Litecoin Wallet: </label></p>
                                    <input type="text" name="litecoinId" id="litecoinId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="ethereumCoinId" style="margin-right: 50px;">Ethereum Wallet: </label></p>
                                    <input type="text" name="ethereumCoinId" id="ethereumCoinId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="usdtCoinId" style="margin-right: 50px;">USDT Wallet: </label></p>
                                    <input type="text" name="usdtCoinId" id="usdtCoinId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="btcCashId" style="margin-right: 50px;">Bitcoin Cash Wallet: </label></p>
                                    <input type="text" name="btcCashId" id="btcCashId" style="width: 400px;" class="col">
                                </div>
                                <div class="text-right">
                                    <input type="submit" value="Go" class="btn">
                                </div>
                            </form>
                        </div>
                    </div>
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