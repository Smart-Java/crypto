<?php
// include_once ('./includes/connection_includes.php');

class UserAccountClass{

    private function getFieldsData($fieldname, $connection)
    {
        $query = "SELECT $fieldname FROM `investors` WHERE `investors_referral_link` = '".$_SESSION['investors_referral_link']."'";
        $query_run = mysqli_query($connection, $query);
    
        if ($query_run) {
            while ($query_run_result = mysqli_fetch_assoc($query_run)) {
                $fieldnameResult = $query_run_result[$fieldname];
                if($fieldnameResult){
                    return $fieldnameResult;
                }
            }
        }
    }

    public function getUserEmail($connection)
    {
        return $this->getFieldsData('email_address', $connection);
    }

    public function checkedSession($connection)
    {
        if (isset($_SESSION['investors_referral_link']) && !empty($_SESSION['investors_referral_link']) && !empty($_GET['investor'])) {
            $code = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);
            $queryCode = "SELECT `investors_id` FROM `investors` WHERE `investors_referral_link` = '$code'";
            $runQueryCode = mysqli_query($connection, $queryCode);
            if ($runQueryCode) {
                $num_rows = mysqli_num_rows($runQueryCode);
                if ($num_rows == 0) {
                    return false;
                } else{
                return true;
                }
            } else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getUsername($connection)
    {
        return $this->getFieldsData('fullname', $connection);
    }

    public function getRegistrationDate($connection)
    {
        return $this->getFieldsData('investors_reg_date', $connection);
    }

    public function getstatus($connection)
    {
        return $this->getFieldsData('status', $connection);
    }

    public function getAccountBalance($connection)
    {
        return round($this->getFieldsData('investors_account_balance', $connection));
    }

    public function getTotalEarning($connection)
    {
        return round($this->getFieldsData('investors_total_earning', $connection));
    }

    public function getActiveDeposit($connection)
    {
        return $this->getFieldsData('investors_active_deposit', $connection);
    }

    public function getLastDeposit($connection)
    {
        return $this->getFieldsData('investors_last_deposit', $connection);
    }

    public function getTotalWithdrawal($connection)
    {
        return $this->getFieldsData('investors_total_withdrawal', $connection);
    }

    // public function getPendingWithdrawal($connection)
    // {
    //     return $this->getFieldsData('investors_pending_withdrawal', $connection);
    // }

    public function getPendingWithdrawal($connection)
    {
        // `withdraw_id`, `withdraw_investor_code`, `means_of_withdraw`, `withdraw_code`, `withdraw_amount`, `withdraw_date`, `withdraw_approved`, `withdraw_comment` FROM `withdraw_deposit`

        $query = "SELECT SUM(`withdraw_amount`) AS `total_pending` FROM `withdraw_deposit` WHERE `withdraw_approved` = '0' AND `withdraw_investor_code` = '".$_SESSION['investors_referral_link']."' AND `isWithdrawalDecline` = '0'";
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
    

    public function getLastWithdrawal($connection)
    {
        return $this->getFieldsData('investors_last_withdrawal', $connection);
    }

    public function getReferralCode($connection)
    {
        return $this->getFieldsData('investors_referral_link', $connection);
    }

    public function getBitcoinCash($connection)
    {
        return $this->getFieldsData('investor_bitcoin_cash', $connection);
    }

    public function getLitecoinCash($connection)
    {
        return $this->getFieldsData('investor_litecoin_cash', $connection);
    }

    public function getEthereumCash($connection)
    {
        return $this->getFieldsData('investor_ethereum_cash', $connection);
    }

    public function getUSDTCash($connection)
    {
        return $this->getFieldsData('investor_usdt_cash', $connection);
    }

    public function investorLink($connection)
    {   
        return 'register.php?investor='.$this->getReferralCode($connection);
    }
    
    public function getNoOfReferral($connection)
    {
        return $this->getFieldsData('no_of_referral', $connection);
    }
}
?>