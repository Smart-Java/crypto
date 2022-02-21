<?php
include_once ('./class/user_account_class.php');

class MakeDepositClass{
    private $plan;
    private $amountToPay;
    private $planMode;

    private $referralCode;

    public function __construct($amount, $stagePlan, String $means) {
        $this->plan = $stagePlan;
        $this->planMode = $means;
        $this->amountToPay = $amount;
    }

    private function checkedIfEmpty()
    {
        if (!empty($this->plan) && !empty($this->amountToPay) && !empty($this->planMode)) {
            return true;
        } else{
            return false;
        }
    }

    public function getActiveAmount($connection)
    {
        // $this->pending = new UserAccountClass();
        // return $this->pending->getPendingWithdrawal($connection);
        $investorCode = $this -> getReferral($connection);
        $selectPendingAmount = "SELECT `investors_active_deposit` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
        $querySelectPendingAmount = mysqli_query($connection, $selectPendingAmount);
        
        if ($querySelectPendingAmount) {
            while ($a = mysqli_fetch_assoc($querySelectPendingAmount)) {
                $result = $a['investors_active_deposit'];
                return $result;
            }
        } else{
            return 'wrong';
        }
    }

    public function getTotalEarning($connection)
    {
        // $this->pending = new UserAccountClass();
        // return $this->pending->getPendingWithdrawal($connection);
        $investorCode = $this -> getReferral($connection);
        $selectTotalAmount = "SELECT `investors_total_earning` FROM `investors` WHERE `investors_referral_link` = '$investorCode'";
        $querySelectTotalAmount = mysqli_query($connection, $selectTotalAmount);
        
        if ($querySelectTotalAmount) {
            while ($a = mysqli_fetch_assoc($querySelectTotalAmount)) {
                $result = $a['investors_total_earning'];
                return $result;
            }
        } else{
            return 'wrong';
        }
    }

    public function getReferral($connection)
    {
        $this->referralCode = new UserAccountClass();
        return $this->referralCode->getReferralCode($connection);
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

    public function referralBonus($connection, $amount)
    {
        $investorReferralCode = $this->getReferral($connection);

        $selectReferral = "SELECT `inviter_referral` FROM `users_through_referrals` WHERE `invitee_referral` = '$investorReferralCode'";
        $querySelectReferral = mysqli_query($connection, $selectReferral);

        if ($querySelectReferral) {
            $numRows = mysqli_num_rows($querySelectReferral);
            if ($numRows == 1) {
                while ($a = mysqli_fetch_assoc($querySelectReferral)) {
                    $result = $a['inviter_referral'];
                    
                    $selectInviterTotalEarning = "SELECT `investors_total_earning` FROM `investors` WHERE `investors_referral_link` = '$result'";
                    $querySelectInviterTotalEarning = mysqli_query($connection, $selectInviterTotalEarning);

                    if ($querySelectInviterTotalEarning) {
                        while ($a = mysqli_fetch_assoc($querySelectInviterTotalEarning)) {
                            $earningResult = $a['investors_total_earning'];
                            
                            $earning = (10 * $amount) / 100;
                            $totalResult = $earning + $earningResult;

                            $updateInviterEarning  = "UPDATE `investors` SET `investors_total_earning` = '$totalResult' WHERE `investors_referral_link` = '$result'";
                            $queryUpdateInviterEarning = mysqli_query($connection, $updateInviterEarning);
                            if ($queryUpdateInviterEarning) {
                                return true;
                            } else{
                                return false;
                            }
                        }
                    }
                }
            }
        }
    }

    public function uploadDeposit($connection)
    {
        $selectedPlan = $this->plan;
        $selectedMethod = $this->planMode;
        $amountToDeposit = $this->amountToPay;

        $isNotEmpty = $this->checkedIfEmpty();

        $date_of_transaction = date('D, d M Y');

        $investorReferralCode = $this->getReferral($connection);

        $transactionMode = 0;

        $code = md5(sha1(sha1(md5(md5(sha1(
            md5(time())
        ))))));

        $transactionCode = substr($code, 0, 7);

        if ($selectedPlan == 'Stage 1') {
            $totalEarning = (3 * $amountToDeposit) / 100;
        } else if($selectedPlan == 'Stage 2'){
            $totalEarning = (7 * $amountToDeposit) / 100;
        }

        if ($isNotEmpty == true) {
            $insertDeposit = "INSERT INTO `deposittransaction`
                (
                    `transaction_id`, 
                    `transaction_code`, 
                    `transaction_plan`, 
                    `transaction_date`, 
                    `transaction_payment_method`, 
                    `is_transaction_approved`, 
                    `investor_referral_code`,
                    `amount`
                )
                VALUES(
                    '',
                    '$transactionCode',
                    '$selectedPlan',
                    '$date_of_transaction',
                    '$selectedMethod',
                    '$transactionMode',
                    '$investorReferralCode',
                    '$amountToDeposit'
                )
                ";
            $queryInsertDeposit = mysqli_query($connection, $insertDeposit);
            if ($queryInsertDeposit) {
                $this->referralBonus($connection, $amountToDeposit);
                $activeAmount = $this->getActiveAmount($connection) + $amountToDeposit;
                $accumulative = $this->getTotalEarning($connection) + $totalEarning + $amountToDeposit;
                $updateInvestorActiveAmount = "UPDATE `investors` SET `investors_last_deposit` = '$amountToDeposit', `investors_total_earning` = '$accumulative' WHERE `investors_referral_link` = '$investorReferralCode'";
                $runUpdateInvestorActiveAmount = mysqli_query($connection, $updateInvestorActiveAmount);

                if ($runUpdateInvestorActiveAmount) {
                    $amountToDeposit = '';
                    $name = $this -> getUserId($connection);
                    $email = $this -> getEmailId($connection);

                    $amount = $this ->amountToPay;
                    
                    //  send user a mail for verification
                    $header = 'MIME-Version: 1.0' ."\r\n";
                    $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                    $from = 'info@fortuneapex.com';

                    $header.= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n".
                    'X-Mailer: PHP/ '. phpversion();

                    $message = '<html><body>';
                    $message .= '<h1>Successful Deposit, @ '.$name.'!</h1>';
                    $message .= '<p>Your deposit of $'.$amount.' has been succesfully made, it only remain confirmation and approve from the admin when you save the depost.</p>';
                    $message .= '<p>Below is your link to save or cancel the deposit, and not saving the deposit makes it to be approve and admin won\'t pay for investment not save.</p>';
                    $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/continue_deposit.php?investor='.$investorReferralCode.'&transCode='.$transactionCode.'"></a>Click Me</p>';
                    $message .= '<p>Copy - https://fortuneapex.com/continue_deposit.php?investor='.$investorReferralCode.'&transCode='.$transactionCode.'</p>';
                    $message .= '<p>Thanks for investing with us.</p>';
                    $message .= '<p>From.</p>';
                    $message .= '<p>FortuneApex Team</p>';
                    $message .= '</body></html>';

                    $subject = 'Deposit Mail';
                    $msg = wordwrap($message);
                    $sendVerification = mail($email, $subject, $msg, $header);
                    
                    if ($sendVerification == true) {
                        $url = 'continue_deposit.php?investor='.$investorReferralCode.'&transCode='.$transactionCode;
                        header('Location:'.$url);
                    }
                } else{
                    return 'Looks like an error occured, try again.';
                }
            } else{
                return 'Error occured, check again please';
            }
        } else{
            return 'One of the fields is empty.';
        }
    }
}
?>