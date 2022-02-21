<?php
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./class/transactions_message_class.php');
include_once ('./includes/connection_includes.php');
    
    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);
    $investorId = $adminConnection -> checkId($connectionResult);

    if ($investorSession == true) {

        $transctionMessage = new TransactionMessageClass();
        
        if (isset($_POST['sendMessageWithdrawalId'])) {
            $transctionMessage -> messageWithdrawal($connectionResult);
        }

        if (isset($_POST['sendMessageDepositId'])) {
            $transctionMessage -> messageDeposit($connectionResult);
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
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Here below are all the withdrawals:</p>
                    </div>
                    <div class="row">
                        <table class="table" style="margin-left: 30px; margin-right: 30px;">
                            <tr style="background-color: #000000; color: #fff;">
                            <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Investor Name</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Withdrawal Investor Code</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Means Of Withdrawal</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Withdrawal Code</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Amount</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Withdrawal Date</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Withdrawal Comment</td>
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
                                $selectWithdrawal = "SELECT `withdraw_id`, `withdraw_investor_code`, `means_of_withdraw`, `withdraw_code`, `withdraw_amount`, `withdraw_date`, `withdraw_comment`, `withdraw_approved` FROM `withdraw_deposit` ORDER BY `withdraw_id` DESC";
                                $querySelectWithdrawal = mysqli_query($connectionResult, $selectWithdrawal);
                                if ($querySelectWithdrawal) {
                                    $numRows = mysqli_num_rows($querySelectWithdrawal);
                                    if ($numRows == 0) {
                                        ?>
                                        </table>
                                            <div class="col-12 text-center">
                                                <p style="font-weight: 700; text-transform: uppercase;">Note: No Pending Withdrawal admin.</p>
                                            </div>
                                        <?php
                                    } else{
                                        while ($a = mysqli_fetch_assoc($querySelectWithdrawal)) {
                                            $withdrawalId = $a['withdraw_id'];
                                            $withdrawalCode = $a['withdraw_code'];
                                            $withdrawalComment = $a['withdraw_comment'];
                                            $withdrawalDate = $a['withdraw_date'];
                                            $withdrawalMeans  = $a['means_of_withdraw'];
                                            $withdrawalAmount  = $a['withdraw_amount'];
                                            $withdrawalInvestorCode = $a['withdraw_investor_code'];
                                            $withdrawalApproved = $a['withdraw_approved'];

                                            $selectName = "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$withdrawalInvestorCode'";
                                            $querySelectName = mysqli_query($connectionResult, $selectName);

                                            if ($querySelectName) {
                                                while ($a = mysqli_fetch_assoc($querySelectName)) {
                                                    $investorName = $a['fullname'];
                                                }
                                            }

                                            ?>
                                            <tr >
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $investorName;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $withdrawalInvestorCode;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $withdrawalMeans;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $withdrawalCode;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo '$'.$withdrawalAmount;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $withdrawalDate;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $withdrawalComment;?></td>
                                                <?php
                                                    if ($withdrawalApproved == '1') {
                                                        ?>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Approved</td>
                                                        <?php
                                                    } else{
                                                        ?>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">
                                                            <form action="transactions.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $withdrawalInvestorCode;?>&withdrawalCode=<?php echo $withdrawalCode;?>" method="post" class="d-inline">
                                                                <input type="submit" value="Send Message" name="sendMessageWithdrawalId" class="btn" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 150px;">
                                                            </form>
                                                        </td>
                                                        <?php
                                                    }
                                                ?>
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
                    <div class="row" style="margin-top: 20px;">
                        <p style="text-transform: uppercase; margin-left: 30px; margin-bottom: 20px; font-weight: 700; color:#000000;">Here below are all the deposit:</p>
                    </div>
                    <div class="row">
                        <table class="table" style="margin-left: 30px; margin-right: 30px;">
                            <tr style="background-color: #000000; color: #fff;">
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Username</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Code</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Plan</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Date</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Payment Method</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Amount</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Investor Code</td>
                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Id</td>
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
                                $selectDeposit = "SELECT `username`, `transaction_code`, `transaction_plan`, `transaction_date`, `transaction_payment_method`, `investor_referral_code`, `amount`, `transId`, `is_transaction_approved`  FROM `deposittransaction` ORDER BY `transaction_id` DESC";
                                $querySelectDeposit = mysqli_query($connectionResult, $selectDeposit);
                                if ($querySelectDeposit) {
                                    $numRows = mysqli_num_rows($querySelectDeposit);
                                    if ($numRows == 0) {
                                        ?>
                                        </table>
                                            <div class="col-12 text-center">
                                                <p style="font-weight: 700; text-transform: uppercase;">Note: No Pending Deposit admin.</p>
                                            </div>
                                        <?php
                                    } else{
                                        while ($a = mysqli_fetch_assoc($querySelectDeposit)) {
                                            $transactionUsername = $a['username'];
                                            $transactionCode = $a['transaction_code'];
                                            $transactionPlan = $a['transaction_plan'];
                                            $transactionDate = $a['transaction_date'];
                                            $transactionPaymentMethod  = $a['transaction_payment_method'];
                                            $transactionAmount  = $a['amount'];
                                            $transactionInvestorCode = $a['investor_referral_code'];
                                            $transactId = $a['transId'];
                                            $isApproved = $a['is_transaction_approved'];
                                            ?>
                                            <tr >
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactionUsername;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactionCode;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactionPlan;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactionDate;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactionPaymentMethod;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo '$'.$transactionAmount;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactionInvestorCode;?></td>
                                                <td style="border: 1px solid #000; height: 50px; padding-right: 20px;"><?php echo $transactId;?></td>
                                                <?php
                                                    if ($isApproved == '1') {
                                                        ?>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">Transaction Approved</td>
                                                        <?php
                                                    } else{
                                                        ?>
                                                        <td style="border: 1px solid #000; height: 50px; padding-right: 20px;">
                                                            <form action="transactions.php?admin=<?php echo $isIdTrue?>&investor=<?php echo $transactionInvestorCode;?>&depositCode=<?php echo $transactionCode;?>" method="post" class="d-inline">
                                                                <input type="submit" value="Send Message" name="sendMessageDepositId" class="btn" style="background-color: rgb(40, 97, 7); color: #fff; margin-bottom: 10px; width: 150px;">
                                                            </form>
                                                        </td>
                                                        <?php
                                                    } 
                                                ?>
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