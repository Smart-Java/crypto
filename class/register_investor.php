<?php

// registration of the new investor

class InvestorRegistrationClass{
    public $email;
    private $password;
    private $confirmPassword;
    private $fullname;
    private $investorUsername; 

    public function __construct(String $iEmail, String $ipassword, String $iConfirmPassword, String $iFullname, String $username) {
        $this->email = $iEmail;
        $this->password = $ipassword;
        $this->confirmPassword = $iConfirmPassword;
        $this->fullname = $iFullname;
        $this-> investorUsername = $username;
    }

    private function checkEmail(){
        $checkedEmail = filter_var($this->email, FILTER_VALIDATE_EMAIL);
        if ($checkedEmail) {
            return true;
        } else{
            return false;
        }
    }

    private function checkIfUserExist($connection)
    {
        $investUsername = $this -> investorUsername;

        $queryUsername = "SELECT `investors_id` FROM `investors` WHERE `investor_username` = '$investUsername'";
        $runQueryUsername = mysqli_query($connection, $queryUsername);
        
        if ($runQueryUsername) {
            $numRows = mysqli_num_rows($runQueryUsername);
            if ($numRows >= 1) {
                return false;
            } else{
                return true;
            }
        } else{
            return false;
        }
    }

    private function emailIfInUsed($connection){
        $investorAddress = $this -> email;

        $queryEmailAddress = "SELECT `investors_id` FROM `investors` WHERE `email_address` = '$investorAddress' AND `deleteAccount` = '0'";
        $runQueryEmailAddress = mysqli_query($connection, $queryEmailAddress);
        
        if ($runQueryEmailAddress) {
            $numRows = mysqli_num_rows($runQueryEmailAddress);
            if ($numRows >= 1) {
                return false;
            } else{
                return true;
            }
        } else{
            return false;
        }
    }

    public function passwordVerification()
    {
        $newPassword = $this -> password;
        
        $length = strlen($newPassword);

        if ($length >=9 && (ctype_alnum($newPassword) == true)) {
            return true;
        } else{
            return false;
        }
    }

    private function checkedPasswordsMatched()
    {
        $investorPassword = $this -> password;
        $investorConfirmPassword = $this -> confirmPassword;

        if ($investorPassword == $investorConfirmPassword) {
            return true;
        } else{
            return false;
        }
    }

    private function investorsReferral()
    {
        $referralNumber  = time();
        $investorKey = 1000000;
        $uniqueReferral = $referralNumber + $investorKey;
         
        return sha1(md5(sha1(sha1(md5(sha1(md5($uniqueReferral).$investorKey.sha1(md5(sha1(sha1(md5($uniqueReferral)))))))))));
    }

    private function checkedEmptyField()
    {
        $investorEmail = $this -> email;
        $investorPass = $this->password;
        $investorConfirmPass = $this -> confirmPassword;
        $investorName = $this -> fullname;

        if (!empty($investorEmail) && !empty($investorPass) && !empty($investorConfirmPass) && !empty($investorName)) {
            return true;
        } else{
            return false;
        }
    }

    // public function uploadNewInvestorWithReferral($connection)
    // {
    //     $emailChecked = $this -> checkEmail();
    //     $emailInUsed = $this -> emailIfInUsed($connection);
    //     $checkMatched = $this -> checkedPasswordsMatched();
    //     $referral = $this -> investorsReferral();
    //     $emptyFields = $this -> checkedEmptyField();
    //     $passwordVerified = $this -> passwordVerification();
    //     $iUsername = $this -> checkIfUserExist($connection);

    //     $investorsFullname = $this -> fullname;
    //     $investorsEmail = $this -> email;
    //     $investorsPassword = $this -> password;

    //     $isVerified = 0;
    //     $totalEarning = 0;
    //     $accountBalance = 0;
    //     $totalWithdrawal = 0;
    //     $pendingWithdrawal = 0;
    //     $last_withdrawal = 0;
    //     $last_deposit = 0;
    //     $active_deposit = 0;

    //     $regDate = date('D, d M Y');

    //     $hashedPassword = md5(sha1(sha1(md5(md5(sha1(
    //         md5($investorsPassword)
    //     ))))));
        
    //     if ($emptyFields == true) {
    //         if ($emailInUsed == true) {
    //             if ($emailChecked == true) {
    //                 if ($passwordVerified == true) {
    //                     if ($checkMatched == true) {
    //                             $insertNewInvestor = "INSERT INTO `investors`
    //                                 (
    //                                     `investors_id`, 
    //                                     `fullname`, 
    //                                     `email_address`, 
    //                                     `investors_referral_link`, 
    //                                     `is_email_verified`, 
    //                                     `investors_password`,
    //                                     `investors_total_earning`,
    //                                     `investors_account_balance`,
    //                                     `investors_active_deposit`,
    //                                     `investors_last_deposit`,
    //                                     `investors_total_withdrawal`,
    //                                     `investors_pending_withdrawal`,
    //                                     `investors_last_withdrawal`,
    //                                     `investors_reg_date`
    //                                 )
    //                                 VALUES(
    //                                     '',
    //                                     '$investorsFullname', 
    //                                     '$investorsEmail', 
    //                                     '$referral', 
    //                                     '$isVerified', 
    //                                     '$hashedPassword',
    //                                     '$totalEarning',
    //                                     '$accountBalance',
    //                                     '$active_deposit',
    //                                     '$last_deposit',
    //                                     '$totalWithdrawal',
    //                                     '$pendingWithdrawal',
    //                                     '$last_withdrawal',
    //                                     '$regDate'
    //                                 )
    //                                 ";
    //                             $queryInsertNewInvestor = mysqli_query($connection, $insertNewInvestor);
    //                             if ($queryInsertNewInvestor) {
    //                                 $insertReferral = "INSERT INTO `users_through_referrals`
    //                                 (
    //                                     `users_referral_id`, 
    //                                     `inviter_referral`, 
    //                                     `invitee_referral`, 
    //                                     `date_registration`
    //                                 )
    //                                 VALUES
    //                                 (
    //                                     '',
    //                                     '$getInvestorCode',
    //                                     '$referral',
    //                                     '$regDate',
    //                                 )
    //                             ";
    //                             $queryInsertReferral = mysqli_query($connection, $insertReferral);

    //                             if ($queryInsertReferral) {
    //                                 $noOfReferrals = "SELECT `users_referral_id` FROM `users_through_referrals` WHERE `inviter_referral` = '$referral'";
    //                                 $queryNoOfReferrals = mysqli_query($connection, $noOfReferrals);

    //                                 if ($queryNoOfReferrals) {
    //                                     $numOfRows = mysqli_num_rows($queryNoOfReferrals);
    //                                     $updateNoOfReferrals = "UPDATE `investors` SET `no_of_referral` = '$numOfRows'";
    //                                     $queryUpdateNoOfReferrals = mysqli_query($connection, $updateNoOfReferrals);
    //                                     if ($queryUpdateNoOfReferrals) {
    //                                         $name = $this -> fullname;
    //                                         $email = $this -> email;

    //                                         $code = $this -> investorsReferral();
    //                                         //  send user a mail for verification
    //                                         $header = 'MIME-Version: 1.0' ."\r\n";
    //                                         $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

    //                                         $from = 'info@fortuneapex.com';

    //                                         $header.= 'From: '.$from."\r\n".
    //                                         'Reply-To: '.$from."\r\n".
    //                                         'X-Mailer: PHP/ '. phpversion();

    //                                         $message = '<html><body>';
    //                                         $message .= '<h1>Almost done, @ '.$name.'!</h1>';
    //                                         $message .= '<p>In order to invest and as well earn with favourable percentage</p>';
    //                                         $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/investor_verification.php?investor='.$code.'"></a>Click Me</p>';
    //                                         $message .= '<p>Copy - https://fortuneapex.com/investor_verification.php?investor='.$code.'</p>';
    //                                         $message .= '<p>If it doesn\'t work, you can copy and paste the link in your browser</p>';
    //                                         $message .= '<p>Once verified, you can enjoy our <b>favourable</b> investments plans </p>';
    //                                         $message .= '</body></html>';

    //                                         $subject = 'Verification Mail';
    //                                         $msg = wordwrap($message);
    //                                         $sendVerification = mail($email, $subject, $msg, $header);
                                            
    //                                         if ($sendVerification == true) {
    //                                             $investorsFullname = '';
    //                                             $investorsEmail = '';
    //                                             $investorsPassword = '';
    //                                             echo '
    //                                                 <script>
    //                                                     alert(\'Successful registration. \nPlease '.$email.', a mail has been sent to your email @'.$investorsEmail.' for verification.\');
    //                                                 </script>
    //                                             ';
    //                                             return true;
    //                                         }
    //                                     }
    //                                 }
    //                             }
    //                         }else{
    //                                 return 'Error occured while processing your registration, investor. <br>try again.';
    //                         }
    //                     } else{
    //                         return 'Password mismatch, Investor.';
    //                     }
    //                 } else{
    //                     return 'Password length must be equal or greater than 9.<br>It must contain numbers and alphabets.';
    //                 }
    //             } else{
    //                 return 'Investor, is like your email address is wrong';
    //             }
    //         } else{
    //             return 'Email Address is already in used, investor';
    //         }
    //     } else{
    //         return 'One of the fields is empty';
    //     }
    // }

    public function uploadNewInvestor($connection)
    {
        $emailChecked = $this -> checkEmail();
        $emailInUsed = $this -> emailIfInUsed($connection);
        $checkMatched = $this -> checkedPasswordsMatched();
        $referral = $this -> investorsReferral();
        $emptyFields = $this -> checkedEmptyField();
        $passwordVerified = $this -> passwordVerification();
        $usernameChecked = $this -> checkIfUserExist($connection);

        $investorsFullname = $this -> fullname;
        $investorsEmail = $this -> email;
        $investorsPassword = $this -> password;
        $iUsername = $this -> investorUsername;


        $isVerified = 1;
        $totalEarning = 0;
        $accountBalance = 0;
        $totalWithdrawal = 0;
        $pendingWithdrawal = 0;
        $last_withdrawal = 0;
        $last_deposit = 0;
        $active_deposit = 0;

        $regDate = date('D, d M Y');

        $hashedPassword = md5(sha1(sha1(md5(md5(sha1(
            md5($investorsPassword)
        ))))));
        
        if($emptyFields == true){
        if ($usernameChecked == true) {
            if ($emailInUsed == true) {
                if ($emailChecked == true) {
                    if ($passwordVerified == true) {
                        if ($checkMatched == true) {
                            if (isset($_GET['investor']) && !empty($_GET['investor'])) {
                                $getInvestorCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);
                                $insertNewInvestor = "INSERT INTO `investors`
                                    (
                                        `investors_id`, 
                                        `fullname`, 
                                        `email_address`, 
                                        `investors_referral_link`, 
                                        `is_email_verified`, 
                                        `investors_password`,
                                        `investors_total_earning`,
                                        `investors_account_balance`,
                                        `investors_active_deposit`,
                                        `investors_last_deposit`,
                                        `investors_total_withdrawal`,
                                        `investors_pending_withdrawal`,
                                        `investors_last_withdrawal`,
                                        `investors_reg_date`,
                                        `investor_username`
                                    )
                                    VALUES(
                                        '',
                                        '$investorsFullname', 
                                        '$investorsEmail', 
                                        '$referral', 
                                        '$isVerified', 
                                        '$hashedPassword',
                                        '$totalEarning',
                                        '$accountBalance',
                                        '$active_deposit',
                                        '$last_deposit',
                                        '$totalWithdrawal',
                                        '$pendingWithdrawal',
                                        '$last_withdrawal',
                                        '$regDate',
                                        '$iUsername'
                                    )
                                    ";
                                $queryInsertNewInvestor = mysqli_query($connection, $insertNewInvestor);
                                if ($queryInsertNewInvestor) {
                                    $insertReferral = "INSERT INTO `users_through_referrals`
                                    (
                                        `users_referral_id`, 
                                        `inviter_referral`, 
                                        `invitee_referral`, 
                                        `date_registration`
                                    )
                                    VALUES
                                    (
                                        '',
                                        '$getInvestorCode',
                                        '$referral',
                                        '$regDate'
                                    )
                                ";
                                $queryInsertReferral = mysqli_query($connection, $insertReferral);

                                if ($queryInsertReferral) {
                                    $noOfReferrals = "SELECT `users_referral_id` FROM `users_through_referrals` WHERE `inviter_referral` = '$getInvestorCode'";
                                    $queryNoOfReferrals = mysqli_query($connection, $noOfReferrals);

                                    if ($queryNoOfReferrals) {
                                        $numOfRows = mysqli_num_rows($queryNoOfReferrals);
                                        $updateNoOfReferrals = "UPDATE `investors` SET `no_of_referral` = '$numOfRows'  WHERE `investors_referral_link` = '$getInvestorCode'";
                                        $queryUpdateNoOfReferrals = mysqli_query($connection, $updateNoOfReferrals);
                                        if ($queryUpdateNoOfReferrals) {
                                            
                                            $selectReferralNameAndEmail = "SELECT `fullname`, `email_address`, `investors_referral_link` FROM `investors` WHERE `investors_referral_link` = '$getInvestorCode'";
                                            $querySelectReferralNameAndEmail = mysqli_query($connection, $selectReferralNameAndEmail);
                                            if ($querySelectReferralNameAndEmail) {
                                                while ($fields = mysqli_fetch_assoc($querySelectReferralNameAndEmail)) {
                                                    $iReferralName = $fields['fullname'];
                                                    $iReferralEmail = $fields['email_address'];
                                                    $iReferralCode = $fields['investors_referral_link'];

                                                    $theInviteeName = $this -> fullname;

                                                    $header = 'MIME-Version: 1.0' ."\r\n";
                                                    $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                                                    $from = 'info@fortuneapex.com';

                                                    $header.= 'From: '.$from."\r\n".
                                                    'Reply-To: '.$from."\r\n".
                                                    'X-Mailer: PHP/ '. phpversion();

                                                    $message = '<html><body>';
                                                    $message .= '<h1>Nice Job, @ '.$iReferralName.'!</h1>';
                                                    $message .= '<p>'.$theInviteeName.' has successfully registered with your link.</p>';
                                                    $message .= '<p>And therefore your number of referral is '.$numOfRows.'.</p>';
                                                    $message .= '<p>Nice job, keep up the good job, '.$iReferralName.'.</p>';
                                                    $message .= '<p>Here\'s your below link to verify the news, '.$iReferralName.':</p>';
                                                    $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$iReferralCode.'"></a>Click Me</p>';
                                                    $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$iReferralCode.'</p>';
                                                    $message .= '<p>Thanks for investing with us.</p>';
                                                    $message .= '<p>From.</p>';
                                                    $message .= '<p>FortuneApex Team</p>';
                                                    $message .= '</body></html>';

                                                    $subject = 'New Referral Mail';
                                                    $msg = wordwrap($message);
                                                    $sendReferralEmail = mail($iReferralEmail, $subject, $msg, $header);
                                                    
                                                        if ($sendReferralEmail == true) {
                                                            $name = $this -> fullname;
                                                            $email = $this -> email;
                
                                                            $code = $this -> investorsReferral();
                                                            //  send user a mail for verification
                                                            $header = 'MIME-Version: 1.0' ."\r\n";
                                                            $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                                                            $from = 'info@fortuneapex.com';
                
                                                            $header.= 'From: '.$from."\r\n".
                                                            'Reply-To: '.$from."\r\n".
                                                            'X-Mailer: PHP/ '. phpversion();
                
                                                            $message = '<html><body>';
                                                            $message .= '<h1>Almost done, @ '.$name.'!</h1>';
                                                            $message .= '<p>In order to invest and as well earn with favourable percentage</p>';
                                                            $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/investor_verification.php?investor='.$code.'"></a>Click Me</p>';
                                                            $message .= '<p>Copy - https://fortuneapex.com/investor_verification.php?investor='.$code.'</p>';
                                                            $message .= '<p>If it doesn\'t work, you can copy and paste the link in your browser</p>';
                                                            $message .= '<p>Once verified, you can enjoy our <b>favourable</b> investments plans </p>';
                                                            $message .= '</body></html>';
                
                                                            $subject = 'Verification Mail';
                                                            $msg = wordwrap($message);
                                                            $sendVerification = mail($email, $subject, $msg, $header);
                                                            
                                                            if ($sendVerification == true) {
                                                                $investorsFullname = '';
                                                                $investorsEmail = '';
                                                                $investorsPassword = '';
                                                                echo '
                                                                    <script>
                                                                        alert(\'Successful registration. \nPlease '.$name.', a mail has been sent to your email @'.$email.' for verification.\');
                                                                    </script>
                                                                ';
                                                                return true;
                                                            }
                                                        } else{
                                                            return 'error occured';
                                                        }
                                                    }
                                                }
                                            }
                                    } else{
                                        return 'Error occured';
                                    }
                                } else{
                                    return 'Error occured';
                                }
                            }else{
                                    return 'Error occured while processing your registration, investor. <br>try again.';
                            }
                            } else{
                                $insertNewInvestor = "INSERT INTO `investors`
                                    (
                                        `investors_id`, 
                                        `fullname`, 
                                        `email_address`, 
                                        `investors_referral_link`, 
                                        `is_email_verified`, 
                                        `investors_password`,
                                        `investors_total_earning`,
                                        `investors_account_balance`,
                                        `investors_active_deposit`,
                                        `investors_last_deposit`,
                                        `investors_total_withdrawal`,
                                        `investors_pending_withdrawal`,
                                        `investors_last_withdrawal`,
                                        `investors_reg_date`,
                                        `investor_username`
                                    )
                                    VALUES(
                                        '',
                                        '$investorsFullname', 
                                        '$investorsEmail', 
                                        '$referral', 
                                        '$isVerified', 
                                        '$hashedPassword',
                                        '$totalEarning',
                                        '$accountBalance',
                                        '$active_deposit',
                                        '$last_deposit',
                                        '$totalWithdrawal',
                                        '$pendingWithdrawal',
                                        '$last_withdrawal',
                                        '$regDate',
                                        '$iUsername'
                                    )
                                    ";
                                $queryInsertNewInvestor = mysqli_query($connection, $insertNewInvestor);
                                if ($queryInsertNewInvestor) {
                                    $name = $this -> fullname;
                                    $email = $this -> email;

                                    $code = $this -> investorsReferral();
                                    //  send user a mail for verification
                                    $header = 'MIME-Version: 1.0' ."\r\n";
                                    $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                                    $from = 'info@fortuneapex.com';

                                    $header.= 'From: '.$from."\r\n".
                                    'Reply-To: '.$from."\r\n".
                                    'X-Mailer: PHP/ '. phpversion();

                                    $message = '<html><body>';
                                    $message .= '<h1>Almost done, @ '.$name.'!</h1>';
                                    $message .= '<p>In order to invest and as well earn with favourable percentage</p>';
                                    $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/investor_verification.php?investor='.$code.'"></a>Click Me</p>';
                                    $message .= '<p>Copy - https://fortuneapex.com/investor_verification.php?investor='.$code.'</p>';
                                    $message .= '<p>If it doesn\'t work, you can copy and paste the link in your browser</p>';
                                    $message .= '<p>Once verified, you can enjoy our <b>favourable</b> investments plans </p>';
                                    $message .= '</body></html>';

                                    $subject = 'Verification Mail';
                                    $msg = wordwrap($message);
                                    $sendVerification = mail($email, $subject, $msg, $header);
                                    
                                    if ($sendVerification == true) {
                                        $investorsFullname = '';
                                        $investorsEmail = '';
                                        $investorsPassword = '';
                                        echo '
                                            <script>
                                                alert(\'Successful registration. \nPlease '.$name.', a mail has been sent to your email @'.$email.' for verification.\');
                                            </script>
                                        ';
                                        return true;
                                    }
                                }else{
                                    return 'Error occured while processing your registration, investor. <br>try again.';
                                }
                            }
                            
                        } else{
                            return 'Password mismatch, Investor.';
                        }
                    } else{
                        return 'Password length must be equal or greater than 9.<br>It must contain numbers and alphabets.';
                    }
                } else{
                    return 'Investor, is like your email address is wrong';
                }
            } else{
                return 'Email Address is already in used, investor';
            }
        } else{
            return 'Username already chosen';
        }
    }else{
        return 'One of the fields is empty';
    }
    }
}
?>