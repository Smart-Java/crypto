<?php
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

class AccountSettingClass{
    private $btcWallet;
    private $litecoinWallet;
    private $usdtWallet;
    private $ethereumWallet;
    private $btcCashWallet;

    public function __construct($btc, $litecoin, $ethereum, $usdt, $btcCash) {
        $this->btcWallet = $btc;
        $this->litecoinWallet = $litecoin;
        $this->usdtWallet = $usdt;
        $this->ethereumWallet = $ethereum;
        $this->btcCashWallet = $btcCash;
    }

    public function investorRef($connection)
    {
        $this->referralCode = new UserAccountClass();
        return $this->referralCode->getReferralCode($connection);
    }

    private function checkIfEmpty()
    {
        if (!empty($this->btcWallet) || !empty($this->litecoinWallet) || !empty($this->usdtWallet) || !empty($this->ethereumWallet) || !empty($this->btcCashWallet)) {
            return true;
        } else{
            return false;
        }
    }

    public function noneIsEmpty()
    {
        if (!empty($this->btcWallet) && !empty($this->litecoinWallet) && !empty($this->usdtWallet) && !empty($this->ethereumWallet) && !empty($this->btcCashWallet)) {
            return true;
        } else{
            return false;
        }
    }

    public function getUserName($connection)
    {
        $referral = $this -> investorRef($connection);
        $queryName = "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$referral'";
        $runQueryName = mysqli_query($connection, $queryName);

        if ($runQueryName) {
            while ($a = mysqli_fetch_assoc($runQueryName)) {
                $name= $a['fullname'];
                return $name;
            }
        } else{
            return false;
        }
    }

    public function getUserEmail($connection)
    {
        $referral = $this -> investorRef($connection);
        $queryEmail = "SELECT `email_address` FROM `investors` WHERE `investors_referral_link` = '$referral'";
        $runQueryEmail = mysqli_query($connection, $queryEmail);

        if ($runQueryEmail) {
            while ($a = mysqli_fetch_assoc($runQueryEmail)) {
                $email= $a['email_address'];
                return $email;
            }
        } else{
            return false;
        }
    }

    public function getUserReferralLink($connection)
    {
        $referral = $this -> investorRef($connection);
        $queryReferralLink = "SELECT `investors_referral_link` FROM `investors` WHERE `investors_referral_link` = '$referral'";
        $runQueryReferralLink = mysqli_query($connection, $queryReferralLink);

        if ($runQueryReferralLink) {
            while ($a = mysqli_fetch_assoc($runQueryReferralLink)) {
                $link = $a['investors_referral_link'];
                return 'login.php?investor='.$link;
            }
        } else{
            return false;
        }
    }

    public function updateInvestorRecord($connection)
    {
        $isNotEmpty = $this->checkIfEmpty();
        $investor = $this->investorRef($connection);
        $bitcoin = $this->btcWallet;
        $litecoin = $this->litecoinWallet;
        $usdtCoin = $this->usdtWallet;
        $ethereumCoin = $this->ethereumWallet;
        $btcCashCoin = $this->btcCashWallet;
        $noneEmpty = $this->noneIsEmpty(); 

        if ($isNotEmpty == false) {
            return 'One of the wallet fields is expected to not to be empty, investor';
        } else{
           
            if ($bitcoin != null || $bitcoin != '') {
                $updateInvestorBitCoinRecord = "UPDATE `investors` SET `investors_btc_wallet` = '$bitcoin' WHERE `investors_referral_link` = '$investor'";
                $queryUpdateInvestorBitcoinRecord = mysqli_query($connection, $updateInvestorBitCoinRecord);

                if ($queryUpdateInvestorBitcoinRecord) {
                    return 'Successful update of bitcoin wallet, investor';
                } else{
                    return 'Failed to update investor, check again.';
                }
            }

            if ($litecoin != null || $litecoin != '') {
                $updateInvestorLitecoinRecord = "UPDATE `investors` SET `investors_litecoin_wallet` = '$litecoin' WHERE `investors_referral_link` = '$investor'";
                $queryUpdateInvestorLitecoinRecord = mysqli_query($connection, $updateInvestorLitecoinRecord);

                if ($queryUpdateInvestorLitecoinRecord) {
                    return 'Successful update of litecoin wallet, investor';
                } else{
                    return 'Failed to update investor, check again.';
                }
            }

            if ($usdtCoin != null || $usdtCoin != '') {
                $updateInvestorUsdtCoinRecord = "UPDATE `investors` SET `investors_usdt_wallet` = '$usdtCoin' WHERE `investors_referral_link` = '$investor'";
                $queryUpdateInvestorUsdtCoinRecord = mysqli_query($connection, $updateInvestorUsdtCoinRecord);

                if ($queryUpdateInvestorUsdtCoinRecord) {
                    return 'Successful update of usdt wallet, investor';
                } else{
                    return 'Failed to update investor, check again.';
                }
            }

            if ($ethereumCoin != null || $ethereumCoin != '') {
                $updateInvestorEthereumCoinRecord = "UPDATE `investors` SET `investors_ethereum_wallet` = '$ethereumCoin' WHERE `investors_referral_link` = '$investor'";
                $queryUpdateInvestorEthereumCoinRecord = mysqli_query($connection, $updateInvestorEthereumCoinRecord);

                if ($queryUpdateInvestorEthereumCoinRecord) {
                    return 'Successful update of ethereum wallet, investor';
                } else{
                    return 'Failed to update investor, check again.';
                }
            }

            if ($btcCashCoin != null || $btcCashCoin != '') {
                $updateInvestorBtcCashCoinRecord = "UPDATE `investors` SET `investor_btccash_wallet` = '$btcCashCoin' WHERE `investors_referral_link` = '$investor'";
                $queryUpdateInvestorBtcCashCoinRecord = mysqli_query($connection, $updateInvestorBtcCashCoinRecord);

                if ($queryUpdateInvestorBtcCashCoinRecord) {
                    return 'Successful update of btc cash wallet, investor';
                } else{
                    return 'Failed to update investor, check again.';
                }
            }
        }
    }

}

?>