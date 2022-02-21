<?php 
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./class/update_admin_info_class.php');
include_once ('./class/update_admin_wallets_class.php');
include_once ('./includes/connection_includes.php');
    
    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);

    $information = '';
    
    if ($investorSession == true) {
        $investorId = $adminConnection -> checkId($connectionResult);
        $btcWallet = $adminConnection -> getBtcWallet($connectionResult);
        $litecoinWallet = $adminConnection -> getLitecoinWallet($connectionResult);
        $ethereumWallet = $adminConnection -> getEthereumWallet($connectionResult);
        $bitcoinCashWallet = $adminConnection -> getBitcoinCashWallet($connectionResult);
        $usdtWallet = $adminConnection -> getUSDTWallet($connectionResult);
        $adminName = $adminConnection -> getName($connectionResult);
        $adminPin = $adminConnection -> getPin($connectionResult);
        
        if (isset($_POST['updateWalletId'])) {
            $bitCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['btcWalletId'])), FILTER_SANITIZE_STRING);
            $liteCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['litecoinWalletId'])), FILTER_SANITIZE_STRING);
            $btcCashCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['bitcoinCashWalletId'])), FILTER_SANITIZE_STRING);
            $ethereumCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['ethereumWalletId'])), FILTER_SANITIZE_STRING);
            $usdtCoin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['usdtWalletId'])), FILTER_SANITIZE_STRING);
            
            $updateAdminWallet = new UpdateAdminWallets($bitCoin, $liteCoin, $usdtCoin, $ethereumCoin, $btcCashCoin);
            $result = $updateAdminWallet -> updateWalletAddress($connectionResult);
            $information = $result;
        }

        if (isset($_POST['updateInfoId'])) {
            $name = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['adminNameId'])), FILTER_SANITIZE_STRING);
            $pin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['adminPinId'])), FILTER_SANITIZE_STRING);
            $confirmPin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['adminConfirmPinId'])), FILTER_SANITIZE_STRING);

            $updateAdminInfo = new UpdateAdminInfoClass($name, $pin, $confirmPin);
            $result = $updateAdminInfo -> updateAdminInfo($connectionResult);
            $information = $result;
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
        <a class="navbar-brand" href="#" style="color: #fff;">Edit Account</a>
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
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="#" style="color: #FFA500; text-decoration: none;">Profile</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="annoucement_upload.php" style="color: white; text-decoration: none;">Account History</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="blog_upload.php" style="color: white; text-decoration: none;">Make Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Withdraw Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Account Settings</a></li>

                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-12 col-sm-12 col-md-12" style="margin-top: 70px;">
                    <div class="row">
                        <p class="text-left ml-4" style="text-transform: Uppercase; font-weight: bold;">Account Profile Information</p>
                    </div>
                    <div class="row"style="margin-top: 0px;">
                        <p class="text-left ml-4" style="text-transform: Uppercase; font-weight: normal;"><?php echo $information;?></p>
                    </div>
                    <hr style="background-color: #000; height: 1.5; margin-top:0px;">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 50%; margin-left: 15px;">
                            <form class="row d-inline" method="post" action="admin_setting.php?admin=<?php echo $investorId;?>">
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Fullname: </p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $adminName;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="adminNameId" style="margin-right: 50px;">Admin Name: </label></p>
                                    <input type="text" name="adminNameId" id="adminNameId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="adminPinId" style="margin-right: 50px;">Admin Pin Code: </label></p>
                                    <input type="text" name="adminPinId" id="adminPinId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="adminConfirmPinId" style="margin-right: 50px;">Confirm Admin Pin Code: </label></p>
                                    <input type="text" name="adminConfirmPinId" id="adminConfirmPinId" style="width: 400px;" class="col">
                                </div>
                                <div class="text-right">
                                    <input type="submit" value="Go" class="btn" name="updateInfoId">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <p class="text-left ml-4" style="font-weight: 700; text-transform: Uppercase;">Wallet Update</p>
                    </div>
                    <hr style="background-color: #000; height: 1.5; margin-top:0px;">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 50%; margin-left: 15px;">
                            <form class="row d-inline" method="post" action="admin_setting.php?admin=<?php echo $investorId;?>">
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Bitcoin Wallet </p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $btcWallet;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Litecoin Wallet:</p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $litecoinWallet;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Bitcoin Cash Wallet:</p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $bitcoinCashWallet;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">USDT Wallet:</p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $usdtWallet;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Ethereum Wallet</p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $ethereumWallet;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="btcWalletId" style="margin-right: 50px;">BTC Wallet: </label></p>
                                    <input type="text" name="btcWalletId" id="btcWalletId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="litecoinWalletId" style="margin-right: 50px;">Litecoin Wallet: </label></p>
                                    <input type="text" name="litecoinWalletId" id="litecoinWalletId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="usdtWalletId" style="margin-right: 50px;">USDT Wallet: </label></p>
                                    <input type="text" name="usdtWalletId" id="usdtWalletId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="ethereumWalletId" style="margin-right: 50px;">Ethereum Wallet: </label></p>
                                    <input type="text" name="ethereumWalletId" id="ethereumWalletId" style="width: 400px;" class="col">
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="bitcoinCashWalletId" style="margin-right: 50px;">Bitcoin Cash Wallet: </label></p>
                                    <input type="text" name="bitcoinCashWalletId" id="bitcoinCashWalletId" style="width: 400px;" class="col">
                                </div>
                                <div class="text-right">
                                    <input type="submit" value="Go" class="btn" name="updateWalletId">
                                </div>
                            </form>
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