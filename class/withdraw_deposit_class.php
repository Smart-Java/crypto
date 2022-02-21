<?php
include_once ('./class/user_account_class.php');

class WithdrawDepositClass{
    public $amountToWithdraw;
    private $commentOnWithdraw;
    public $meansSelected;

    private $accountBalance;

    private $meansBalance;

    private $referralCode;

    private $pending;

    public function __construct($amount, $comment, $means) {
        $this ->amountToWithdraw = $amount;
        $this ->commentOnWithdraw = $comment;
        $this ->meansSelected = $means;
    }

    public function getAccountBalance($connection)
    {
        $this->accountBalance = new UserAccountClass();
        return $this->accountBalance->getAccountBalance($connection); 
    }

    public function getReferral($connection)
    {
        $this->referralCode = new UserAccountClass();
        return $this->referralCode->getReferralCode($connection);
    }

    public function checkDate($connection)
    {
        $investor = $this -> getReferral($connection);

        $selectDate = "SELECT `transaction_date` FROM `deposittransaction` WHERE `investor_referral_code` = '$investor' AND `is_transaction_approved` = '1' ORDER BY `transaction_id` DESC";
        $querySelectDate = mysqli_query($connection, $selectDate);

        if ($querySelectDate) {
            $numRows = mysqli_num_rows($querySelectDate);
            if ($numRows == 0) {
                return false;
            } else if($numRows == 1){
                while ($a = mysqli_fetch_assoc($querySelectDate)) {
                    $date = $a['transaction_date'];
    
                    $currentDate = date('D, d M Y');
                    // $currentDate = 'Sun, 26 Sep 2021';
    
                    if ($date == $currentDate) {
                        return false;
                    } else{
                        return true;
                    }
                }
            } else{
                return true;
            }
        } else{
            return false;
        }
    }

    public function getPendingAmount($connection)
    {
        // $this->pending = new UserAccountClass();
        // return $this->pending->getPendingWithdrawal($connection);
        $query = "SELECT SUM(`withdraw_amount`) AS `total_pending` FROM `withdraw_deposit` WHERE `withdraw_approved` = '0' AND `withdraw_investor_code` = '".$_SESSION['investors_referral_link']."'";
        $query_run = mysqli_query($connection, $query);
    
        if ($query_run) {
            while ($query_run_result = mysqli_fetch_assoc($query_run)) {
                $fieldnamePending = $query_run_result['total_pending'];
                // if($fieldnameResult){

                //     return $fieldnameResult;
                // }
                $update = "UPDATE `investors` SET `investors_pending_withdrawal` = '$fieldnamePending' WHERE  `investors_referral_link` = '".$_SESSION['investors_referral_link']."'";
                $queryUpdate = mysqli_query($connection, $update);
            
                if ($queryUpdate) {
                    while ($query_run_result = mysqli_fetch_assoc($queryUpdate)) {
                        $selectPendingAmount = "SELECT `investors_pending_withdrawal` FROM `investors` WHERE `investors_referral_link` = '".$_SESSION['investors_referral_link']."'";
                        $querySelectPendingAmount = mysqli_query($connection, $selectPendingAmount);
                        if ($querySelectPendingAmount) {
                            while ($c = mysqli_fetch_assoc($querySelectPendingAmount)) {
                                $fieldnameResult = $c['investors_pending_withdrawal'];
                                if($fieldnameResult){
                                    
                                    return $fieldnameResult;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function getBalanceMeans($connection)
    {
        $this->meansBalance = new UserAccountClass();
        $selectedOption = $this ->meansSelected;

        if ($selectedOption == 'Bitcoin') {
            return $this->meansBalance->getBitcoinCash($connection);
        } else if ($selectedOption == 'Litecoin') {
            return $this->meansBalance->getLitecoinCash($connection);
        } else if ($selectedOption == 'USDT') {
            return $this->meansBalance->getUSDTCash($connection);
        } else if ($selectedOption == 'Ethereum') {
            return $this->meansBalance->getEthereumCash($connection);
        } else if ($selectedOption == 'Bitcoin Cash') {
            return $this->meansBalance->getBitcoinCash($connection);
        }
    }

    public function checkIfTransactionIsPossibleWithTotal($connection)
    {
        $aBalance = $this->getAccountBalance($connection);
        $amountRequested = $this->amountToWithdraw;

        if ($amountRequested <= $aBalance) {
            return true;
        } else{
            return false;
        }
    }

    public function getUserId($connection)
    {
        $referral = $this -> getReferral($connection);
        $queryTransaction = "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$referral'";
        $runQueryTransaction = mysqli_query($connection, $queryTransaction);

        if ($runQueryTransaction) {
            while ($a = mysqli_fetch_assoc($runQueryTransaction)) {
                $name= $a['fullname'];
                return $name;
            }
        } else{
            return false;
        }
    }

    public function getEmailId($connection)
    {
        $referral = $this -> getReferral($connection);
        $queryTransaction = "SELECT `email_address` FROM `investors` WHERE `investors_referral_link` = '$referral'";
        $runQueryTransaction = mysqli_query($connection, $queryTransaction);

        if ($runQueryTransaction) {
            while ($a = mysqli_fetch_assoc($runQueryTransaction)) {
                $result= $a['email_address'];
                return $result;
            }
        } else{
            return false;
        }
    }

    public function checkIfTransactionIsPossibleWithMeans($connection)
    {
        $mBalance = $this->getBalanceMeans($connection);
        $amtRequested = $this ->amountToWithdraw;

        if ($amtRequested <= $mBalance) {
            return true;
        } else{
            return false;
        }
    }

    public function getWithdrawalMeansWallet($connection)
    {
        $meansToWithdraw = $this -> meansSelected;
        $investorCode = $this->getReferral($connection);

        if ($meansToWithdraw == 'Bitcoin') {
            $selectUserBitcoinWallet = "SELECT `investors_btc_wallet` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
            $querySelectUserBitcoinWallet = mysqli_query($connection, $selectUserBitcoinWallet);
            if ($querySelectUserBitcoinWallet) {
                while ($a = mysqli_fetch_assoc($querySelectUserBitcoinWallet)) {
                    $userBtcWallet = $a['investors_btc_wallet'];
                    return $userBtcWallet;
                }
            }
        } else if($meansToWithdraw == 'Litecoin'){
            $selectUserLitecoinWallet = "SELECT `investors_litecoin_wallet` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
            $querySelectUserLitecoinWallet = mysqli_query($connection, $selectUserLitecoinWallet);
            if ($querySelectUserLitecoinWallet) {
                while ($b = mysqli_fetch_assoc($querySelectUserLitecoinWallet)) {
                    $userLitecoinWallet = $b['investors_litecoin_wallet'];
                    return $userLitecoinWallet;
                }
            }
        } else if($meansToWithdraw == 'Ethereum'){
            $selectUserEthereumWallet = "SELECT `investors_ethereum_wallet` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
            $querySelectUserEthereumWallet = mysqli_query($connection, $selectUserEthereumWallet);
            if ($querySelectUserEthereumWallet) {
                while ($c = mysqli_fetch_assoc($querySelectUserEthereumWallet)) {
                    $userEthereumWallet = $c['investors_ethereum_wallet'];
                    return $userEthereumWallet;
                }
            }
        } else if($meansToWithdraw == 'USDT'){
            $selectUserUSDTWallet = "SELECT `investors_usdt_wallet` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
            $querySelectUserUSDTWallet = mysqli_query($connection, $selectUserUSDTWallet);
            if ($querySelectUserUSDTWallet) {
                while ($d = mysqli_fetch_assoc($querySelectUserUSDTWallet)) {
                    $userUSDTWallet = $d['investors_usdt_wallet'];
                    return $userUSDTWallet;
                }
            }
        } else if($meansToWithdraw == 'Bitcoin Cash'){
            $selectUserBitcoinCashWallet = "SELECT `investor_btccash_wallet` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
            $querySelectUserBitcoinCashWallet = mysqli_query($connection, $selectUserBitcoinCashWallet);
            if ($querySelectUserBitcoinCashWallet) {
                while ($e = mysqli_fetch_assoc($querySelectUserBitcoinCashWallet)) {
                    $userBitcoinCashWallet = $e['investor_btccash_wallet'];
                    return $userBitcoinCashWallet;
                }
            }
        }
    }

    public function performInsertWithdrawal($connection)
    {
        $amt = $this->amountToWithdraw;
        $meansToPay = $this->meansSelected;
        $com = $this->commentOnWithdraw;

        $date_of_withdraw = date('D, d M Y');

        $investorReferralCode = $this->getReferral($connection);

        $transactionMode = 0;

        $code = md5(sha1(sha1(md5(md5(sha1(
            md5(time())
        ))))));

        $withdrawCode = substr($code, 0, 11);

        $userWithdrawalMeansWallet = $this -> getWithdrawalMeansWallet($connection);

        $actualPendingAmount = substr($this->pending, 1);

        // $totalPendingAmount =  $actualPendingAmount + $amt;

        $possibleWithTotal = $this->checkIfTransactionIsPossibleWithTotal($connection);
        $possibleWithMeans = $this->checkIfTransactionIsPossibleWithMeans($connection);

        if ($possibleWithTotal == true) {
            echo 'true';
            // if ($possibleWithMeans == true) {
            //     // upload in withdraw_deposit and update the pending withdraw in investors
                
            // }else{
            //     return 'You can\'t withdraw with, '.$meansToPay.'your '.$meansToPay.' balance is low.';
            // }
            $queryInsertWithdraw = "INSERT INTO `withdraw_deposit`
                (
                    `withdraw_id`, 
                    `withdraw_investor_code`, 
                    `means_of_withdraw`, 
                    `withdraw_code`, 
                    `withdraw_amount`, 
                    `withdraw_date`, 
                    `withdraw_approved`,
                    `withdraw_comment`,
                    `withDrawalWallet`
                )
                VALUES(
                    '',
                    '$investorReferralCode',
                    '$meansToPay',
                    '$withdrawCode',
                    '$amt',
                    '$date_of_withdraw',
                    '$transactionMode',
                    '$com',
                    '$userWithdrawalMeansWallet'
                )
                ";
                $runQueryInsertWithdraw = mysqli_query($connection, $queryInsertWithdraw);

                if ($runQueryInsertWithdraw) {
                    $pendedAmount = $this->getPendingAmount($connection) + $amt;
                    $updateInvestorPendingAmount = "UPDATE `investors` SET `investors_pending_withdrawal` = '$pendedAmount', `investors_last_withdrawal` = '$amt' WHERE `investors_referral_link` = '$investorReferralCode'";
                    $runUpdateInvestorPendingAmount = mysqli_query($connection, $updateInvestorPendingAmount);

                    if ($runUpdateInvestorPendingAmount) {
                        $name = $this -> getUserId($connection);
                        $email = $this -> getEmailId($connection);

                        $amount = $this -> amountToWithdraw;

                        //  send user a mail for verification
                        $header = 'MIME-Version: 1.0' ."\r\n";
                        $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                        $from = 'info@fortuneapex.com';

                        $header.= 'From: '.$from."\r\n".
                        'Reply-To: '.$from."\r\n".
                        'X-Mailer: PHP/ '. phpversion();

                        $message = '<html><body>';
                        $message .= '<h1>Successful Withdraw of Deposit, @ '.$name.'!</h1>';
                        $message .= '<p>Your withdraw of deposit of $'.$amount.'has been succesfully requested, relax and wait for approval and confirmation from the admin.</p>';
                        $message .= '<p>Below is your link view your profile:</p>';
                        $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investorReferralCode.'"></a>Click Me</p>';
                        $message .= '<p>Or Copy - https://fortuneapex.com/user_profile.php?investor='.$investorReferralCode.'</p>';
                        $message .= '<p>Thanks for investing with us.</p>';
                        $message .= '<p>From.</p>';
                        $message .= '<p>FortuneApex Team</p>';
                        $message .= '</body></html>';

                        $subject = 'Withdraw of Deposit Mail';
                        $msg = wordwrap($message);
                        $sendVerification = mail($email, $subject, $msg, $header);
                        
                        if ($sendVerification == true) {
                            echo "
                                alert('Successful request, wait patient as it is on progress investor');
                            ";
                            return 'Successful withdraw, soon the transaction will reflect.';
                        }
                    } else{
                        return 'Looks like an error occured, try again.';
                    }
                }
        } else{
            return 'You can\'t withdraw, your balance is low.';
        }
    }

}
?>