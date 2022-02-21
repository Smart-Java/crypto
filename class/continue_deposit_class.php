<?php
include_once ('./class/user_account_class.php');

class ContinueDepositClass{
    private $referralCode;
    private $transactCode;

    private $transactId;
    private $username;

    // public function __construct(String $depositId) {
    //     $this->transactId = $depositId;
    // }

    public function investorRef($connection)
    {
        $this->referralCode = new UserAccountClass();
        return $this->referralCode->getReferralCode($connection);
    }

    public function getUserId($connection)
    {
        $referral = $this -> investorRef($connection);
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
        $referral = $this -> investorRef($connection);
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

    private function getTransactCode($connection)
    {
        if (!empty($_GET['transCode'])) {
            $investorTransact = filter_var(trim(mysqli_real_escape_string($connection, $_GET['transCode'])), FILTER_SANITIZE_STRING);

            return $investorTransact;
        } else{
            return false;
        }
    }

    private function getTransactReferral($connection)
    {
        if (!empty($_GET['investor'])) {
            $investorRef = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);

            return $investorRef;
        } else{
            return false;
        }
    }

    public function checkInvestorRef($connection)
    {
        $investorCode = $this -> getTransactReferral($connection);
        $queryInvestorCode = "SELECT `investor_referral_code` FROM `deposittransaction` WHERE `investor_referral_code` = '$investorCode'";
        $runQueryInvestorCode = mysqli_query($connection, $queryInvestorCode);

        if ($runQueryInvestorCode) {
            while ($a = mysqli_fetch_assoc($runQueryInvestorCode)) {
                $code = $a['investor_referral_code'];
                return $code;
            }
        } else{
            return false;
        }
    }

    public function checkTransactionId($connection)
    {
        $code = $this -> getTransactCode($connection);
        $queryTransactionId = "SELECT `transaction_code` FROM `deposittransaction` WHERE `transaction_code` = '$code'";
        $runQueryTransactionId = mysqli_query($connection, $queryTransactionId);

        if ($runQueryTransactionId) {
            while ($a = mysqli_fetch_assoc($runQueryTransactionId)) {
                $code = $a['transaction_code'];
                return $code;
            }
        } else{
            return false;
        }
    }

    public function getPlan($connection)
    {
        $transactionCode = $this -> checkTransactionId($connection);

        $queryPlan = "SELECT `transaction_plan` FROM `deposittransaction` WHERE `transaction_code` = '$transactionCode'";
        $runQueryPlan = mysqli_query($connection, $queryPlan);

        if ($runQueryPlan) {
            while ($a = mysqli_fetch_assoc($runQueryPlan)) {
                $plan = $a['transaction_plan'];
                return $plan;
            }
        }
    }

    public function getProfit($connection)
    {
        return '-';
    }

    public function getPricipalWithdrawal($connection)
    {
        return '-';
    }

    public function getCreditAccount($connection)
    {
        $transactionCode = $this -> checkTransactionId($connection);

        $queryCredit = "SELECT `transaction_payment_method` FROM `deposittransaction` WHERE `transaction_code` = '$transactionCode'";
        $runQueryCredit = mysqli_query($connection, $queryCredit);

        if ($runQueryCredit) {
            while ($a = mysqli_fetch_assoc($runQueryCredit)) {
                $credit = $a['transaction_payment_method'];
                return $credit;
            }
        }
    }

    public function getWallet($connection)
    {
        $account = $this -> getCreditAccount($connection);

        $selectWallet = "SELECT `wallet` FROM `admin_wallets` WHERE `account` = '$account'";
        $runSelectWallet = mysqli_query($connection, $selectWallet);

        if ($runSelectWallet) {
            while ($a = mysqli_fetch_assoc($runSelectWallet)) {
                $wallet = $a['wallet'];
                return $wallet;
            }
        }
    }

    public function getDepositFee($connection)
    {
        $transactionCode = $this -> checkTransactionId($connection);

        $queryDepositFee = "SELECT `amount` FROM `deposittransaction` WHERE `transaction_code` = '$transactionCode'";
        $runQueryDepositFee = mysqli_query($connection, $queryDepositFee);

        if ($runQueryDepositFee) {
            while ($a = mysqli_fetch_assoc($runQueryDepositFee)) {
                $amount = $a['amount'];
                return $amount;
            }
        }
    }

    public function getDepositAmount($connection)
    {
        $transactionCode = $this -> checkTransactionId($connection);

        $queryDepositAmount = "SELECT `amount` FROM `deposittransaction` WHERE `transaction_code` = '$transactionCode'";
        $runQueryDepositAmount = mysqli_query($connection, $queryDepositAmount);

        if ($runQueryDepositAmount) {
            while ($a = mysqli_fetch_assoc($runQueryDepositAmount)) {
                $amount = $a['amount'];
                return $amount;
            }
        }
    }

    public function saveTransaction($connection, $transPin)
    {
        $name = $this -> getUserId($connection);
        $transaction = $this -> checkTransactionId($connection);
        $code = $this->investorRef($connection);

        $transactionId = $transPin;

        $savedTransaction = 1;

        if ($name == false) {
            return 'You have not made a transaction, investor '.$name.' <br>Follow this link to make one: <a href="user_profile.php?investor='.$this->getTransactReferral($connection).'">'.$name.'</a>';
        } else{
            // if ($transaction != false) {
                
            // } 
            $updateSave = "UPDATE `deposittransaction` SET `saved_transaction` = '$savedTransaction', `transId` = '$transactionId', `username` = '$name' WHERE `transaction_code` = '$transaction' AND `investor_referral_code` = '$code'";
            $queryUpdateSave = mysqli_query($connection, $updateSave);

            if ($queryUpdateSave) {
                $name = $this -> getUserId($connection);
                $email = $this -> getEmailId($connection);

                $amount = $this -> getDepositAmount($connection);
                //  send user a mail for verification
                $header = 'MIME-Version: 1.0' ."\r\n";
                $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                $from = 'info@fortuneapex.com';

                $header.= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n".
                'X-Mailer: PHP/ '. phpversion();

                $message = '<html><body>';
                $message .= '<h1>Successful Deposit, @ '.$name.'!</h1>';
                $message .= '<p>Your deposit of $'.$amount.'has been succesfully saved, relax and watch your money grow.</p>';
                $message .= '<p>Below is your link view your profile:</p>';
                $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$code.'"></a>Click Me</p>';
                $message .= '<p>Or Copy - https://fortuneapex.com/user_profile.php?investor='.$code.'</p>';
                $message .= '<p>Thanks for investing with us.</p>';
                $message .= '<p>From.</p>';
                $message .= '<p>FortuneApex Team</p>';
                $message .= '</body></html>';

                $subject = 'Successful deposit Mail';
                $msg = wordwrap($message);
                $sendVerification = mail($email, $subject, $msg, $header);
                
                if ($sendVerification == true) {
                    $url = "user_profile.php?investor=".$code;
                    header('Location: '.$url);
                }
            } else{
                return 'You have not made a transaction, investor '.$name.'. <br>Follow this link to make one: <a href="user_profile.php?investor='.$this->getTransactReferral($connection).'">'.$name.'</a>';
            }
        }
    }

    public function cancelTransaction($connection, $transPin)
    {
        $transaction = $this -> checkTransactionId($connection);
        $name = $this -> getUserId($connection);
        $code = $this->investorRef($connection);
        $transactionId = $transPin;
        $notSavedTransaction = 0;

        $updateLastDeposit = "UPDATE `investors` SET `investors_last_deposit` = '0.0' WHERE `investors_referral_link` = '$code'";
        $queryUpdateLastDeposit = mysqli_query($connection, $updateLastDeposit);

        if ($queryUpdateLastDeposit) {
            $updateCancel = "UPDATE `deposittransaction` SET `saved_transaction` = '$notSavedTransaction', `transId` = '$transactionId', `username` = '$name' WHERE `transaction_code` = '$transaction' AND `investor_referral_code` = '$code'";
            $queryUpdateCancel = mysqli_query($connection, $updateCancel);

            if ($queryUpdateCancel) {
                $name = $this -> getUserId($connection);
                    $email = $this -> getEmailId($connection);

                    $amount = $this -> getDepositAmount($connection);
                    //  send user a mail for verification
                    $header = 'MIME-Version: 1.0' ."\r\n";
                    $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                    $from = 'info@fortuneapex.com';

                    $header.= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n".
                    'X-Mailer: PHP/ '. phpversion();

                    $message = '<html><body>';
                    $message .= '<h1>Deposit Cancelled, @ '.$name.'!</h1>';
                    $message .= '<p>Your deposit of $'.$amount.'has been succesfully cancelled.</p>';
                    $message .= '<p>Below is your link of your deposit, in case you want to approve it again:</p>';
                    $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/continue_deposit.php?investor='.$code.'&transCode='.$transaction.'"></a>Click Me</p>';
                    $message .= '<p>Or Copy - https://fortuneapex.com/continue_deposit.php?investor='.$code.'&transCode='.$transaction.'</p>';
                    $message .= '<p>Thanks for investing with us.</p>';
                    $message .= '<p>From.</p>';
                    $message .= '<p>FortuneApex Team</p>';
                    $message .= '</body></html>';

                    $subject = 'Successful deposit Mail';
                    $msg = wordwrap($message);
                    $sendVerification = mail($email, $subject, $msg, $header);
                    
                    if ($sendVerification == true) {
                        $url = "user_profile.php?investor=".$code;
                        header('Location: '.$url);
                    }
                $url = "user_profile.php?investor=".$code;
                header('Location: '.$url);
            }
        }
    }
}
?>