<?php
session_start();
class InvestorLoginClass{
    private $emailAddress;
    private $password;

    public function __construct(String $email, String $pass) {
        $this->emailAddress = $email;
        $this->password = $pass;
    }

    private function checkEmpty()
    {
        $iEmail = $this -> emailAddress;
        $iPassword = $this -> password;

        if (!empty($iEmail) && !empty($iPassword)) {
            return true;
        } else{
            return false;
        }
    }

    private function checkInvestor($connection)
    {
        $investorMail = $this -> emailAddress;
        $investorPass = $this -> password;

        $hashPassword = md5(sha1(sha1(md5(md5(sha1(
            md5($investorPass)
        ))))));

        $queryInvestor = "SELECT `investors_referral_link`, `is_email_verified` FROM `investors` WHERE `email_address` = '$investorMail' AND `investors_password` = '$hashPassword' AND `suspendAccount` = '0' AND `deleteAccount` = '0'";
        $runQueryInvestor = mysqli_query($connection, $queryInvestor);

        if ($runQueryInvestor) {
            $numRows = mysqli_num_rows($runQueryInvestor);
            if ($numRows == 1) {
                return $runQueryInvestor;
            } else{
                return false;
            }
        } else{
            return false;
        }
    }

    public function loginInvestor($connection)
    {
        $isEmpty = $this -> checkEmpty();
        $investor = $this -> checkInvestor($connection);
        
        if ($isEmpty == true) {
            if ($investor == false) {
                return 'It looks like you are not yet an investor, why not register?';
            } else{
                while ($a = mysqli_fetch_assoc($investor)) {
                    $referral = $a['investors_referral_link'];
                    $verified = $a['is_email_verified'];
    
                    if ($verified == 0) {
                        return 'Your account has not be verified, investor.';
                    } else{
                        $checkNoOfInvestorsOnline = "SELECT `investors_id` FROM `investors` WHERE `status` = '1'";
                        $queryCheckNoOfInvestorsOnline = mysqli_query($connection, $checkNoOfInvestorsOnline);
                        if ($queryCheckNoOfInvestorsOnline) {
                            $numRowsOfOnlineInvestors = mysqli_num_rows($queryCheckNoOfInvestorsOnline);
                            if ($numRowsOfOnlineInvestors < 20) {
                                $_SESSION['investors_referral_link'] = $referral;
    
                                $url = 'user_profile.php?investor='.$referral;
                                
                                $updateStatus = "UPDATE `investors` SET `status` = '1' WHERE `investors_referral_link` = '$referral'";
                                $queryUpdateStatus = mysqli_query($connection, $updateStatus);
                                if ($queryUpdateStatus) {
                                    header('Location: '.$url);
                                }
                            } else{
                                $url = '503.php';
                                header('Location: '.$url);
                            }
                        }
                        // $_SESSION['investors_referral_link'] = $referral;
    
                        // $url = 'user_profile.php?investor='.$referral;
                        
                        // $updateStatus = "UPDATE `investors` SET `status` = '1' WHERE `investors_referral_link` = '$referral'";
                        // $queryUpdateStatus = mysqli_query($connection, $updateStatus);
                        // if ($queryUpdateStatus) {
                        //     header('Location: '.$url);
                        // }
                    }
                }
            }
        } else{
            return 'One of the field is empty.';
        }
    }
}

?>