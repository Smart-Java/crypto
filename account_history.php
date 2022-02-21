<?php
session_start();
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

$userAccount = new UserAccountClass();

if ($userAccount -> checkedSession($connectionResult) == true) {
    $userName = $userAccount-> getUsername($connectionResult);
    $userReferral = $userAccount -> getReferralCode($connectionResult);
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
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 60px;">
        <a class="navbar-brand" href="#" style="color: #fff;">Dashboard</a>
        
            <a href="./user_dashboard.php?investor=<?php echo $userReferral;?>" class="d-lg-block d-sm-block d-md-block">
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
                        <div class="col-xl-12 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 150px; margin-left: 15px;">
                            <form class="row d-inline" method="post" action="account_history.php?investor=<?php echo $userReferral;?>">
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px;">
                                    <div class="col-6">
                                        <Select class="form-control" name="transactionTypeId" style="margin-left: 15px;">
                                            <option value="All Transaction">All Transaction</option>
                                            <option value="Withdrawals">Withdrawals</option>
                                            <option value="Deposit">Deposit </option>
                                        </Select>
                                    </div>
                                    <!-- <div style="width: 35%; padding-left: 10px;">
                                        <div class="row">
                                            <label for="fromId" class="mx-4" style="font-weight: 700; font-size: 16px;">From: </label><input type="month" name="fromMonthId" id="fromMonthId" class="form-control" style="width: 40%;"><input type="number" name="fromDayId" id="fromMonthId" class="form-control" style="width: 20%;">
                                        </div>
                                    </div>
                                    <div  style="width: 35%;">
                                        <div class="row">
                                            <label for="toId" class="mx-4" style="font-weight: 700; font-size: 16px;">To: </label><input type="month" name="toMonthId" id="toMonthId" class="form-control" style="width: 40%;"><input type="number" name="toDayId" id="toDayId" class="form-control" style="width: 20%;">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="text-right mt-4">
                                    <input type="submit" value="Go" class="btn">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div  style="text-align: center; margin-top: 15px; width: 100%; margin-right: 15px; margin-left: 15px;">
                        <div style="border-radius: 15px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff;">Type</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff;">Amount</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff;">Method</td>
                                    <td style="border: 1px solid #000; height: 50px; padding-right: 200px; background-color: #000; color: #fff;">Date</td>
                                </tr>
                                <?php
                                    include_once ('./includes/connection_includes.php');
                                    //  
                                    // if (isset($_POST['transactionTypeId']) && isset($_POST['fromMonthId']) && isset($_POST['fromDayId']) && isset($_POST['toMonthId']) && isset($_POST['toDayId'])) {
                                    //     $type = $_POST['transactionTypeId'];
                                    //     $fromMonth = $_POST['fromMonthId'];
                                    //     $fromDay = $_POST['fromDayId'];
                                    //     $toMonth = $_POST['toMonthId'];
                                    //     $toDay = $_POST['toDayId'];

                                    //     $actualFromDate = $fromDay.' '.$fromMonth;

                                    //     echo "<script>alert('".$actualFromDate."')</script>";
                                    // }

                                    if (isset($_POST['transactionTypeId'])) {
                                        $type = $_POST['transactionTypeId'];

                                        if ($type == 'All Transaction') {
                                            // select the transaction of  deposit
                                            $selectDeposit = "SELECT `transaction_date`, `transaction_payment_method`, `amount` FROM `deposittransaction` WHERE `investor_referral_code` = '$userReferral' AND `is_transaction_approved` = '1' ORDER BY `transaction_date` DESC";
                                            $querySelectDeposit = mysqli_query($connectionResult, $selectDeposit);

                                            if ($querySelectDeposit) {
                                                while ($a = mysqli_fetch_assoc($querySelectDeposit)) {
                                                    $amount = $a['amount'];
                                                    $dateOfTransaction = $a['transaction_date'];
                                                    $methodOfTransaction = $a['transaction_payment_method'];
                                                    $transactionType = 'Deposit';
                                                    ?>
                                                    <tr>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $transactionType;?></td>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo '$'.$amount;?></td>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $methodOfTransaction;?></td>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 200px;"><?php echo $dateOfTransaction;?></td>
                                                    </tr>
                                                    <?php
                                                    $selectWithdrawal = "SELECT `means_of_withdraw`, `withdraw_amount`, `withdraw_date` FROM `withdraw_deposit` WHERE `withdraw_investor_code` = '$userReferral' AND `withdraw_approved` = '1'";
                                                    $querySelectWithdrawal = mysqli_query($connectionResult, $selectWithdrawal);

                                                    if ($querySelectWithdrawal) {
                                                        while ($b = mysqli_fetch_assoc($querySelectWithdrawal)) {
                                                            $amount = $b['withdraw_amount'];
                                                            $dateOfTransaction = $b['withdraw_date'];
                                                            $methodOfTransaction = $b['means_of_withdraw'];
                                                            $transactionType = 'Withdrawal';

                                                            ?>
                                                            <tr>
                                                                <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $transactionType;?></td>
                                                                <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo '$'.$amount;?></td>
                                                                <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $methodOfTransaction;?></td>
                                                                <td style="border: 1px solid #000; height: 50px; padding-right: 200px;"><?php echo $dateOfTransaction;?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                        } else if ($type == 'Withdrawals'){
                                            $selectWithdrawal = "SELECT `means_of_withdraw`, `withdraw_amount`, `withdraw_date` FROM `withdraw_deposit` WHERE `withdraw_investor_code` = '$userReferral' AND `withdraw_approved` = '1'";
                                            $querySelectWithdrawal = mysqli_query($connectionResult, $selectWithdrawal);

                                            if ($querySelectWithdrawal) {
                                                $numRows = mysqli_num_rows($querySelectWithdrawal);
                                                if ($numRows == 0) {
                                                    ?>
                                                    </table>
                                                        <div class="col-12 text-center">
                                                            <p style="font-weight: 700; text-transform: uppercase;">Note: No withdrawal yet.</p>
                                                        </div>
                                                    <?php
                                                } else{
                                                    while ($b = mysqli_fetch_assoc($querySelectWithdrawal)) {
                                                        $amount = $b['withdraw_amount'];
                                                        $dateOfTransaction = $b['withdraw_date'];
                                                        $methodOfTransaction = $b['means_of_withdraw'];
                                                        $transactionType = 'Withdrawal';

                                                        ?>
                                                        <tr>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $transactionType;?></td>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo '$'.$amount;?></td>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $methodOfTransaction;?></td>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px;"><?php echo $dateOfTransaction;?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        } else if ($type == 'Deposit'){
                                            $selectDeposit = "SELECT `transaction_date`, `transaction_payment_method`, `amount` FROM `deposittransaction` WHERE `investor_referral_code` = '$userReferral' AND `is_transaction_approved` = '1' ORDER BY `transaction_date` DESC";
                                            $querySelectDeposit = mysqli_query($connectionResult, $selectDeposit);

                                            if ($querySelectDeposit) {
                                                $numRows = mysqli_num_rows($querySelectDeposit);
                                                if ($numRows == 0) {
                                                    ?>
                                                    </table>
                                                        <div class="col-12 text-center">
                                                            <p style="font-weight: 700; text-transform: uppercase;">Note: No Deposit yet.</p>
                                                        </div>
                                                    <?php
                                                }else{
                                                    while ($a = mysqli_fetch_assoc($querySelectDeposit)) {
                                                        $amount = $a['amount'];
                                                        $dateOfTransaction = $a['transaction_date'];
                                                        $methodOfTransaction = $a['transaction_payment_method'];
                                                        $transactionType = 'Deposit';
                                                        ?>
                                                        <tr>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $transactionType;?></td>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo '$'.$amount;?></td>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px; color: #000;"><?php echo $methodOfTransaction;?></td>
                                                            <td style="border: 1px solid #000; height: 50px; padding-right: 200px;"><?php echo $dateOfTransaction;?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
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