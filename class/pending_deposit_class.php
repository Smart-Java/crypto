<?php

class PendingDepositClass{
    public function getInvestorCode($connection)
    {   
        if (isset($_GET['investor']) && !empty($_GET['investor'])) {
            $investorCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);
            return $investorCode;
        } else{
            return false;
        }
    }

    public function getDepositCode($connection)
    {   
        if (isset($_GET['depositCode']) && !empty($_GET['depositCode'])) {
            $depositCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['depositCode'])), FILTER_SANITIZE_STRING);
            return $depositCode;
        } else{
            return false;
        }
    }

    public function referralBonus($connection, $amount)
    {
        $investorReferralCode = $this->getInvestorCode($connection);

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
            } else{
                return false;
            }
        }
    }

    public function approveDeposit($connection)
    {
        $investor = $this -> getInvestorCode($connection);
        $deposit = $this -> getDepositCode($connection);

        $updateApproveDeposit = "UPDATE `deposittransaction` SET `is_transaction_approved` = '1' WHERE `investor_referral_code` = '$investor' AND `transaction_code` = '$deposit'";
        $queryUpdateApproveDeposit = mysqli_query($connection, $updateApproveDeposit);

        if ($queryUpdateApproveDeposit) {
            $selectAmount = "SELECT `amount`, `transaction_plan` FROM `deposittransaction` WHERE `investor_referral_code` = '$investor' AND `transaction_code` = '$deposit'";
            $querySelectAmount = mysqli_query($connection, $selectAmount);

            if ($querySelectAmount) {
                while ($a = mysqli_fetch_assoc($querySelectAmount)) {
                    $amount = $a['amount'];
                    $plan = $a['transaction_plan'];

                    $selectNameAndEmailAddressAmount = "SELECT `fullname`, `email_address` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                    $querySelectNameAndEmailAddressAmount = mysqli_query($connection, $selectNameAndEmailAddressAmount);

                    if ($querySelectNameAndEmailAddressAmount) {
                        while ($c = mysqli_fetch_assoc($querySelectNameAndEmailAddressAmount)) {
                            $nameAmount = $c['fullname'];
                            $emailAmount = $c['email_address'];

                            $updateInvestorLastAmount = "UPDATE `investors` SET `investors_last_deposit` = '$amount' WHERE `investors_referral_link` = '$investor'";
                            $runUpdateInvestorLastAmount = mysqli_query($connection, $updateInvestorLastAmount);

                            if ($runUpdateInvestorLastAmount) {
                                // $amountToDeposit = '';
                                // $name = $this -> getUserId($connection);
                                // $email = $this -> getEmailId($connection);

                                // $amount = $this ->amountToPay;
                                
                                //  send user a mail for verification
                                $header = 'MIME-Version: 1.0' ."\r\n";
                                $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                                $from = 'info@fortuneapex.com';

                                $header.= 'From: '.$from."\r\n".
                                'Reply-To: '.$from."\r\n".
                                'X-Mailer: PHP/ '. phpversion();

                                $message = '<html><body>';
                                $message .= '<h1>Successful Deposit, @ '.$nameAmount.'!</h1>';
                                $message .= '<p>Your deposit of $'.$amount.' has been succesfully made, it only remain confirmation and approve from the admin when you save the depost.</p>';
                                $message .= '<p>Below is your link to save or cancel the deposit, and not saving the deposit makes it to be approve and admin won\'t pay for investment not save.</p>';
                                $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/continue_deposit.php?investor='.$investor.'&transCode='.$deposit.'"></a>Click Me</p>';
                                $message .= '<p>Copy - https://fortuneapex.com/continue_deposit.php?investor='.$investor.'&transCode='.$deposit.'</p>';
                                $message .= '<p>Thanks for investing with us.</p>';
                                $message .= '<p>From.</p>';
                                $message .= '<p>FortuneApex Team</p>';
                                $message .= '</body></html>';

                                $subject = 'Deposit Mail';
                                $msg = wordwrap($message);
                                $sendDeposit = mail($emailAmount, $subject, $msg, $header);
                                
                                if ($sendDeposit == true) {
                                    $selectNameAndEmailAddress = "SELECT `fullname`, `email_address`, `investors_account_balance`, `investors_active_deposit`, `investors_total_earning` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                                    $querySelectNameAndEmailAddress = mysqli_query($connection, $selectNameAndEmailAddress);

                                    if ($querySelectNameAndEmailAddress) {
                                        while ($b = mysqli_fetch_assoc($querySelectNameAndEmailAddress)) {
                                            $name = $b['fullname'];
                                            $email = $b['email_address'];
                                            $balance = $b['investors_account_balance'];
                                            $active = $b['investors_active_deposit'];
                                            $earning = $b['investors_total_earning'];

                                            $activeBalance = $active + $amount;

                                            $this->referralBonus($connection, $amount);


                                            
                                            $updateActiveBalance = "UPDATE `investors` SET `investors_active_deposit` = '$activeBalance' WHERE `investors_referral_link` = '$investor'";
                                            $queryUpdateActiveBalance = mysqli_query($connection, $updateActiveBalance);

                                            if ($queryUpdateActiveBalance) {
                                                //  send user a mail for verification
                                                $header = 'MIME-Version: 1.0' ."\r\n";
                                                $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                                                $from = 'info@fortuneapex.com';

                                                $header.= 'From: '.$from."\r\n".
                                                'Reply-To: '.$from."\r\n".
                                                'X-Mailer: PHP/ '. phpversion();

                                                $message = '<html><body>';
                                                $message .= '<h1>Successful Approval of Deposit, @ '.$name.'!</h1>';
                                                $message .= '<p>Your deposit of $'.$amount.' has been succesfully approved.</p>';
                                                $message .= '<p>Your total balance is $'.$balance.'.</p>';
                                                $message .= '<p>Your active balance is $'.$activeBalance.'.</p>';
                                                $message .= '<p>Your total earning balance is $'.$earning.'.</p>';
                                                $message .= '<p>Below is your link of your profile.</p>';
                                                $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                                                $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                                                $message .= '<p>Thanks for investing with us.</p>';
                                                $message .= '<p>From.</p>';
                                                $message .= '<p>FortuneApex Team</p>';
                                                $message .= '</body></html>';

                                                $subject = 'Approved Deposit Mail';
                                                $msg = wordwrap($message);
                                                $sendApproveDeposit= mail($email, $subject, $msg, $header);
                                                
                                                if ($sendApproveDeposit == true) {
                                                    echo "
                                                    <script>
                                                            alert(
                                                                'Successfully approval of deposit admin.'
                                                            );
                                                    </script>
                                                        ";
                                                }
                                            }

                                        }
                                    } else{
                                        return 'Looks like an error occured, try again.';
                                    }
                                }
                            }




                            // real code

                            // $updateActiveBalance = "UPDATE `investors` SET `investors_active_deposit` = '$activeBalance' WHERE `investors_referral_link` = '$investor'";
                            // $queryUpdateActiveBalance = mysqli_query($connection, $updateActiveBalance);

                            // if ($queryUpdateActiveBalance) {
                            //     //  send user a mail for verification
                            //     $header = 'MIME-Version: 1.0' ."\r\n";
                            //     $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                            //     $from = 'info@fortuneapex.com';

                            //     $header.= 'From: '.$from."\r\n".
                            //     'Reply-To: '.$from."\r\n".
                            //     'X-Mailer: PHP/ '. phpversion();

                            //     $message = '<html><body>';
                            //     $message .= '<h1>Successful Approval of Deposit, @ '.$name.'!</h1>';
                            //     $message .= '<p>Your deposit of $'.$amount.' has been succesfully approved.</p>';
                            //     $message .= '<p>Your total balance is $'.$balance.'.</p>';
                            //     $message .= '<p>Your active balance is $'.$activeBalance.'.</p>';
                            //     $message .= '<p>Your total earning balance is $'.$earning.'.</p>';
                            //     $message .= '<p>Below is your link of your profile.</p>';
                            //     $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                            //     $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                            //     $message .= '<p>Thanks for investing with us.</p>';
                            //     $message .= '<p>From.</p>';
                            //     $message .= '<p>FortuneApex Team</p>';
                            //     $message .= '</body></html>';

                            //     $subject = 'Approved Deposit Mail';
                            //     $msg = wordwrap($message);
                            //     $sendVerification = mail($email, $subject, $msg, $header);
                                
                            //     if ($sendVerification == true) {
                            //         echo "
                            //         <script>
                            //                 alert(
                            //                     'Successfully approval of deposit admin.'
                            //                 );
                            //         </script>
                            //             ";
                            //     }
                            // }
                        }
                    }
                }
            }
        }
    }

    public function declineDeposit($connection)
    {
        $investor = $this -> getInvestorCode($connection);
        $deposit = $this -> getDepositCode($connection);

        $updateApproveDeposit = "UPDATE `deposittransaction` SET `is_transaction_approved` = '0', `isDepositDecline` = '1' WHERE `investor_referral_code` = '$investor' AND `transaction_code` = '$deposit'";
        $queryUpdateApproveDeposit = mysqli_query($connection, $updateApproveDeposit);

        if ($queryUpdateApproveDeposit) {
            $selectAmount = "SELECT `amount` FROM `deposittransaction` WHERE `investor_referral_code` = '$investor' AND `transaction_code` = '$deposit'";
            $querySelectAmount = mysqli_query($connection, $selectAmount);

            if ($querySelectAmount) {
                while ($a = mysqli_fetch_assoc($querySelectAmount)) {
                    $amount = $a['amount'];

                    $selectNameAndEmailAddress = "SELECT `fullname`, `email_address`, `investors_account_balance`, `investors_active_deposit`, `investors_total_earning` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                    $querySelectNameAndEmailAddress = mysqli_query($connection, $selectNameAndEmailAddress);

                    if ($querySelectNameAndEmailAddress) {
                        while ($b = mysqli_fetch_assoc($querySelectNameAndEmailAddress)) {
                            $name = $b['fullname'];
                            $email = $b['email_address'];
                            $balance = $b['investors_account_balance'];
                            $active = $b['investors_active_deposit'];
                            $earning = $b['investors_total_earning'];

                            $newBalance = $balance;

                            $updateTotalBalance = "UPDATE `investors` SET `investors_account_balance` = '$newBalance' , `investors_last_deposit` = '0.0' WHERE `investors_referral_link` = '$investor'";
                            $queryUpdateTotalBalance = mysqli_query($connection, $updateTotalBalance);

                            if ($queryUpdateTotalBalance) {
                                //  send user a mail for verification
                                $header = 'MIME-Version: 1.0' ."\r\n";
                                $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                                $from = 'info@fortuneapex.com';

                                $header.= 'From: '.$from."\r\n".
                                'Reply-To: '.$from."\r\n".
                                'X-Mailer: PHP/ '. phpversion();

                                $message = '<html><body>';
                                $message .= '<h1>Decline of Deposit, @ '.$name.'!</h1>';
                                $message .= '<p>Your deposit of $'.$amount.' has been declined.</p>';
                                $message .= '<p>Your total balance is $'.$balance.'.</p>';
                                $message .= '<p>Your active balance is $'.$active.'.</p>';
                                $message .= '<p>Your total earning balance is $'.$earning.'.</p>';
                                $message .= '<p>Contact the admin through this link to know why: https://fortuneapex.com/contact.php</p>';
                                $message .= '<p>Below is your link of your profile.</p>';
                                $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                                $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                                $message .= '<p>Thanks for investing with us.</p>';
                                $message .= '<p>From.</p>';
                                $message .= '<p>FortuneApex Team</p>';
                                $message .= '</body></html>';

                                $subject = 'Approved Deposit Mail';
                                $msg = wordwrap($message);
                                $sendVerification = mail($email, $subject, $msg, $header);
                                
                                if ($sendVerification == true) {
                                    echo "
                                    <script>
                                            alert(
                                                'Successfully decline of deposit admin.'
                                            );
                                    </script>
                                        ";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>