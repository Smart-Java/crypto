<?php

class AdminAccounClass{
    public function checkId($connection)
    {
        if (isset($_GET['admin']) && !empty($_GET['admin'])) {
            $adminCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['admin'])), FILTER_SANITIZE_STRING);
            
            $queryId = "SELECT `code` FROM `special_login` WHERE `code` = '$adminCode'";
            $runQueryId = mysqli_query($connection, $queryId);

            if ($runQueryId) {
                $numRows = mysqli_num_rows($runQueryId);
                if ($numRows == 0) {
                    return false;
                } else{
                    while ($a = mysqli_fetch_assoc($runQueryId)) {
                        $result = $a['code'];
                        return $result;
                    }
                }
            }
        } else{
            return false;
        }
    }

    public function checkSession($connection)
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            return true;
        } else{
            return false;
        }
    }

    public function getWallets($accountType, $connection)
    {
        if (isset($_GET['admin']) && !empty($_GET['admin'])) {
            $adminCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['admin'])), FILTER_SANITIZE_STRING);
            
            $queryField = "SELECT `wallet` FROM `admin_wallets` WHERE `account` = '$accountType'";
            $runQueryField = mysqli_query($connection, $queryField);

            if ($runQueryField) {
                while ($a = mysqli_fetch_assoc($runQueryField)) {
                    $result = $a['wallet'];
                    return $result;
                }
            }
        } else{
            return false;
        }
    }

    public function getAccountInfo($infoname, $connection)
    {
        if (isset($_GET['admin']) && !empty($_GET['admin'])) {
            $adminCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['admin'])), FILTER_SANITIZE_STRING);
            
            $queryInfo = "SELECT $infoname FROM `special_login` WHERE `code` = '$adminCode'";
            $runQueryInfo = mysqli_query($connection, $queryInfo);

            if ($runQueryInfo) {
                while ($a = mysqli_fetch_assoc($runQueryInfo)) {
                    $result = $a[$infoname];
                    return $result;
                }
            }
        } else{
            return false;
        }
    }

    public function getFullName($connection)
    {
        $investor = $_GET['investor'];

        $selectTotal= "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$investor'";
        $querySelectTotal= mysqli_query($connection, $selectTotal);

        if ($querySelectTotal) {
            while ($b = mysqli_fetch_assoc($querySelectTotal)) {
                $name = $b['fullname'];
                return $name;
            }
        }
    }

    public function getName($connection)
    {
        return $this->getAccountInfo('admin_name', $connection);
    }

    public function getPin($connection)
    {
        return $this->getAccountInfo('admin_pin', $connection);
    }

    public function getStatus($connection)
    {
        return $this->getAccountInfo('status', $connection);
    }

    public function getBtcWallet($connection)
    {
        return $this->getWallets('Bitcoin', $connection);
    }

    public function getLitecoinWallet($connection)
    {
        return $this->getWallets('Litecoin', $connection);
    }

    public function getEthereumWallet($connection)
    {
        return $this->getWallets('Ethereum', $connection);
    }

    public function getBitcoinCashWallet($connection)
    {
        return $this->getWallets('Bitcoin Cash', $connection);
    }

    public function getUSDTWallet($connection)
    {
        return $this->getWallets('USDT', $connection);
    }

    public function getPendingWithdrawal($connection)
    {
        $pendingWithdrawal = "SELECT `withdraw_id` FROM `withdraw_deposit` WHERE `withdraw_approved` = '0' AND `isWithdrawalDecline` = '0'";
        $queryPendingWithdrawal = mysqli_query($connection, $pendingWithdrawal);

        if ($queryPendingWithdrawal) {
            $numRows = mysqli_num_rows($queryPendingWithdrawal);
            if ($numRows >= 1) {
                return $numRows;
            } else{
                return 0;
            }
        }
    }

    public function getApprovedWithdrawal($connection)
    {
        $pendingWithdrawal = "SELECT `withdraw_id` FROM `withdraw_deposit` WHERE `withdraw_approved` = '1'";
        $queryPendingWithdrawal = mysqli_query($connection, $pendingWithdrawal);

        if ($queryPendingWithdrawal) {
            $numRows = mysqli_num_rows($queryPendingWithdrawal);
            if ($numRows >= 1) {
                return $numRows;
            } else{
                return 0;
            }
        }
    }

    public function getPendingDeposit($connection)
    {
        $pendingDeposit = "SELECT `transaction_id` FROM `deposittransaction` WHERE `is_transaction_approved` = '0' AND `saved_transaction` = '1' AND `isDepositDecline` = '0'";
        $queryPendingDeposit = mysqli_query($connection, $pendingDeposit);

        if ($queryPendingDeposit) {
            $numRows = mysqli_num_rows($queryPendingDeposit);
            if ($numRows >= 1) {
                return $numRows;
            } else{
                return 0;
            }
        }
    }

    public function getApprovedDeposit($connection)
    {
        $pendingDeposit = "SELECT `transaction_id` FROM `deposittransaction` WHERE `is_transaction_approved` = '1'";
        $queryPendingDeposit = mysqli_query($connection, $pendingDeposit);

        if ($queryPendingDeposit) {
            $numRows = mysqli_num_rows($queryPendingDeposit);
            if ($numRows >= 1) {
                return $numRows;
            } else{
                return 0;
            }
        }
    }
}
?>