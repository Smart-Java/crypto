<?php

class UpdateAdminWallets{
    private $btc;
    private $litecoin;
    private $usdt;
    private $ethereum;
    private $bitcoinCash;

    public function __construct(String $btcWallet, String $liteWallet, String $usdtWallet, String $ethereumWallet, String $bitcoinCashWallet) {
        $this->btc = $btcWallet;
        $this->litecoin = $liteWallet;
        $this->usdt = $usdtWallet;
        $this->ethereum = $ethereumWallet;
        $this->bitcoinCash = $bitcoinCashWallet; 
    }

    private function checkedIfAllIsEmpty()
    {
        if (!empty($this->btc) && !empty($this->litecoin) && !empty($this->usdt) && !empty($this->ethereum) && !empty($this->bitcoinCash)) {
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

    public function updateWalletAddress($connection)
    {
        $bitCoin = $this->btc;
        $liteCoin = $this->litecoin;
        $usdtCoin = $this-> usdt;
        $ethereumCoin = $this-> ethereum;
        $btcCashCoin = $this->bitcoinCash;

        $isAllNotEmpty = $this -> checkedIfAllIsEmpty();

        if ($isAllNotEmpty == true) {
            if ($bitCoin != null && $liteCoin != null && $usdtCoin != null && $ethereumCoin != null && $btcCashCoin != null) {
                $updateBitcoin = "UPDATE `admin_wallets` SET wallet = '$bitCoin' WHERE `account` = 'Bitcoin'";
                $queryUpdateBitcoin = mysqli_query($connection, $updateBitcoin);
                if ($queryUpdateBitcoin) {
                    $updateLitecoin = "UPDATE `admin_wallets` SET `wallet` = '$liteCoin' WHERE `account` = 'Litecoin'";
                    $queryUpdateLitecoin = mysqli_query($connection, $updateLitecoin);
                    if ($queryUpdateLitecoin) {
                        $updateUSDTCoin = "UPDATE `admin_wallets` SET `wallet` = '$usdtCoin' WHERE `account` = 'USDT'";
                        $queryUpdateUSDTCoin = mysqli_query($connection, $updateUSDTCoin);
                        if ($queryUpdateUSDTCoin) {
                            $updateEthereumCoin = "UPDATE `admin_wallets` SET `wallet` = '$ethereumCoin' WHERE `account` = 'Ethereum'";
                            $queryUpdateEthereumCoin = mysqli_query($connection, $updateEthereumCoin);
                            if ($queryUpdateEthereumCoin) {
                                $updateBitcoinCashCoin = "UPDATE `admin_wallets` SET `wallet` = '$btcCashCoin' WHERE `account` = 'Bitcoin Cash'";
                                $queryUpdateBitcoinCashCoin = mysqli_query($connection, $updateBitcoinCashCoin);
                                if ($queryUpdateBitcoinCashCoin) {
                                    return 'Success update';
                                } else{
                                    return 'Try again for successful update';
                                }
                            }
                        }
                    }
                } else{
                    if ($bitCoin != null) {
                        $updateBitcoin = "UPDATE `admin_wallets` SET wallet = '$bitCoin' WHERE `account` = 'Bitcoin'";
                        $queryUpdateBitcoin = mysqli_query($connection, $updateBitcoin);
                        if ($queryUpdateBitcoin) {
                            return 'Success update of Bitcoin';
                        } else{
                            return 'Try again for successful update';
                        }
                    }

                    if ($liteCoin!= null) {
                        $updateLitecoin = "UPDATE `admin_wallets` SET `wallet` = '$liteCoin' WHERE `account` = 'Litecoin'";
                        $queryUpdateLitecoin = mysqli_query($connection, $updateLitecoin);
                        if ($queryUpdateLitecoin) {
                            return 'Success update of Litecoin';
                        } else{
                            return 'Try again for successful update';
                        }
                    }

                    if ($ethereumCoin != null) {
                        $updateEthereumCoin = "UPDATE `admin_wallets` SET `wallet` = '$ethereumCoin' WHERE `account` = 'Ethereum'";
                        $queryUpdateEthereumCoin = mysqli_query($connection, $updateEthereumCoin);
                        if ($queryUpdateEthereumCoin) {
                            return 'Success update of Ethereum Coin';
                        } else{
                            return 'Try again for successful update';
                        }
                    }

                    if ($btcCashCoin != null) {
                        $updateBitcoinCashCoin = "UPDATE `admin_wallets` SET `wallet` = '$btcCashCoin' WHERE `account` = 'Bitcoin Cash'";
                        $queryUpdateBitcoinCashCoin = mysqli_query($connection, $updateBitcoinCashCoin);
                        if ($queryUpdateBitcoinCashCoin) {
                            return 'Success update of Bitcoin Cash';
                        } else{
                            return 'Try again for successful update';
                        }
                    }

                    if ($usdtCoin != null) {
                        $updateUSDTCoin = "UPDATE `admin_wallets` SET `wallet` = '$usdtCoin' WHERE `account` = 'USDT'";
                        $queryUpdateUSDTCoin = mysqli_query($connection, $updateUSDTCoin);
                        if ($queryUpdateUSDTCoin) {
                            return 'Success update of USDT Coin';
                        } else{
                            return 'Try again for successful update';
                        }
                    }
                }
            }
        } else{
            return 'You can\'t update empty wallet admin';
        }
    }
}
?>