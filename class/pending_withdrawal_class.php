<?php

class PendingWithdrawalClass{
    public function getInvestorCode($connection)
    {   
        if (isset($_GET['investor']) && !empty($_GET['investor'])) {
            $investorCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);
            return $investorCode;
        } else{
            return false;
        }
    }

    public function getWithdrawalCode($connection)
    {   
        if (isset($_GET['withdrawalCode']) && !empty($_GET['withdrawalCode'])) {
            $withdrawalCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['withdrawalCode'])), FILTER_SANITIZE_STRING);
            return $withdrawalCode;
        } else{
            return false;
        }
    }

    public function getTotalWithdrawal($connection)
    {
        // $investor = $this->getInvestorCode($connection);
        $investor = $_GET['investor'];
        $code = $_GET['withdrawalCode'];
        $one = 1;
        echo "
                <script>
                    alert('".$investor."');
                </script>
                ";
                $a = $investor;
        $query = "SELECT SUM(`withdraw_amount`) AS `total_pending` FROM `withdraw_deposit` WHERE `withdraw_approved` = '$one' AND `withdraw_investor_code` = 'c9693ced2de27ccdf98caedfe8654c3af16ba4ed'";
        $query_run = mysqli_query($connection, $query);
    
        if ($query_run) {
            echo "
                <script>
                    alert('".$investor."');
                </script>
                ";
            while ($query_run_result = mysqli_fetch_assoc($query_run)) {
                $fieldnamePending = $query_run_result['total_pending'];
                echo "
                <script>
                    alert('".$fieldnamePending."');
                    // alert('time".time()."');
                    // alert('time".strtotime('now')."');
                </script>
                ";
            }
        }
    }

    public function approveWithdrawal($connection, $transId)
    {
        $investor = $this -> getInvestorCode($connection);
        $withdraw = $this -> getWithdrawalCode($connection);

        $transactionId = $transId;

        if (!empty($transactionId)) {
            $updateApproveWithdraw = "UPDATE `withdraw_deposit` SET `withdraw_approved` = '1' WHERE `withdraw_investor_code` = '$investor' AND `withdraw_code` = '$withdraw'";
            $queryUpdateApproveWithdraw = mysqli_query($connection, $updateApproveWithdraw);

            if ($queryUpdateApproveWithdraw) {
                $selectAmount = "SELECT `withdraw_amount` FROM `withdraw_deposit` WHERE `withdraw_investor_code` = '$investor' AND `withdraw_code` = '$withdraw'";
                $querySelectAmount = mysqli_query($connection, $selectAmount);

                if ($querySelectAmount) {
                    while ($a = mysqli_fetch_assoc($querySelectAmount)) {
                        $amount = $a['withdraw_amount'];

                        // SELECT SUM(`withdraw_amount`) AS total_pending FROM withdraw_deposit WHERE `withdraw_investor_code` = 'ff060e1496be8dfbcf91174c42e2ac68a7bd9a60' AND `withdraw_approved` = '0'

                        //  $query = "SELECT SUM(`withdraw_amount`) AS `total_pending` FROM `withdraw_deposit` WHERE `withdraw_approved` = '1' AND `withdraw_investor_code` = '$investor'";
                        //  $query_run = mysqli_query($connection, $query);
                    
                        //  if ($query_run) {
                        //      while ($query_run_result = mysqli_fetch_assoc($query_run)) {
                        //          $fieldnamePending = $query_run_result['total_pending'];
                        //          echo "
                        //         <script>
                        //             alert('".$fieldnamePending."');
                        //             // alert('time".time()."');
                        //             // alert('time".strtotime('now')."');
                        //         </script>
                        //     ";

                        $selectNameAndEmailAddress = "SELECT `investors_total_withdrawal`, `fullname`, `email_address`, `investors_account_balance`, `investors_active_deposit`, `investors_total_earning` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                        $querySelectNameAndEmailAddress = mysqli_query($connection, $selectNameAndEmailAddress);

                        if ($querySelectNameAndEmailAddress) {
                            while ($b = mysqli_fetch_assoc($querySelectNameAndEmailAddress)) {
                                $name = $b['fullname'];
                                $email = $b['email_address'];
                                $balance = $b['investors_account_balance'];
                                $active = $b['investors_active_deposit'];
                                $earning = $b['investors_total_earning'];
                                $withdraw = $b['investors_total_withdrawal'];

                                $newBalance = $balance - $amount;
                                $totalWithdrawal = $withdraw + $amount;

                                        $updateTotalBalance = "UPDATE `investors` SET `investors_account_balance` = '$newBalance', `investors_total_withdrawal` = '$totalWithdrawal' WHERE `investors_referral_link` = '$investor'";
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
                                            $message .= '<h1>Approval of Withdrawal, @ '.$name.'!</h1>';
                                            $message .= '<p>Your withdrawal of $'.$amount.' has been approved.</p>';
                                            $message .= '<p>Here\'s the transaction Id : '.$transactionId.'.</p>';
                                            $message .= '<p>Your total balance remains $'.$newBalance.'.</p>';
                                            $message .= '<p>While the active balance and total earning is:.</p>';
                                            $message .= '<p>Your active balance is $'.$active.'.</p>';
                                            $message .= '<p>Your total earning balance is $'.$earning.'.</p>';
                                            $message .= '<p>Below is your link for your profile.</p>';
                                            $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                                            $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                                            $message .= '<p>Thanks for investing with us.</p>';
                                            $message .= '<p>From.</p>';
                                            $message .= '<p>FortuneApex Team</p>';
                                            $message .= '</body></html>';

                                            $subject = 'Approved Withdrawal Mail';
                                            $msg = wordwrap($message);
                                            $sendVerification = mail($email, $subject, $msg, $header);
                                            
                                            if ($sendVerification == true) {
                                                echo "
                                                <script>
                                                        alert(
                                                            'Successfully approval of withdrawal admin.'
                                                        );
                                                </script>
                                                    ";
                                            }
                                        }
                                //     }
                                // }
                            }
                        }
                    }
                }
            }
        } else{
            echo "
                <script>
                        alert(
                            'Transaction Id is empty, admin.'
                        );
                </script>
                    ";
        }
    }

    public function declineWithdrawal($connection)
    {
        $investor = $this -> getInvestorCode($connection);
        $withdraw = $this -> getWithdrawalCode($connection);

        $updateApproveWithdraw = "UPDATE `withdraw_deposit` SET `withdraw_approved` = '0', `isWithdrawalDecline` = '1' WHERE `withdraw_investor_code` = '$investor' AND `withdraw_code` = '$withdraw'";
        $queryUpdateApproveWithdraw = mysqli_query($connection, $updateApproveWithdraw);

        if ($queryUpdateApproveWithdraw) {
            $selectAmount = "SELECT `withdraw_amount` FROM `withdraw_deposit` WHERE `withdraw_investor_code` = '$investor' AND `withdraw_code` = '$withdraw'";
            $querySelectAmount = mysqli_query($connection, $selectAmount);

            if ($querySelectAmount) {
                while ($a = mysqli_fetch_assoc($querySelectAmount)) {
                    $amount = $a['withdraw_amount'];

                    $selectPendingAmount = "SELECT SUM(`withdraw_amount`) AS `total_pending` FROM `withdraw_deposit` WHERE `withdraw_approved` = '0' AND `withdraw_investor_code` = '$investor' AND `isWithdrawalDecline` = '0' `withdraw_code` = '$withdraw'";
                    $querySelectPendingAmount = mysqli_query($connection, $selectPendingAmount);
                
                    if ($querySelectPendingAmount) {
                        while ($pamt = mysqli_fetch_assoc($querySelectPendingAmount)) {
                            $resultPendingAmount = $pamt['total_pending'];

                            // $selectLastWithdrawal = "SELECT `investors_last_withdrawal` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                            // $querySelectLastWithdrawal = mysqli_query($connection, $selectLastWithdrawal);

                            // if ($querySelectLastWithdrawal) {
                            //     while ($lastWithdraw = mysqli_fetch_assoc($querySelectLastWithdrawal)) {
                            //         $resultLastAmount = $lastWithdraw['investors_last_withdrawal'];
                            //         $lastWithdrawal = $resultLastAmount - $amount;
                            //     }
                            // }

                            // $actualPendingAmount = $resultPendingAmount - $amount;

                            $updateActualPendingAmount = "UPDATE `investors` SET `investors_pending_withdrawal` = '$resultPendingAmount', `investors_last_withdrawal` = '0' WHERE `investors_referral_link` = '$investor'";
                            $queryUpdateActualPendingAmount = mysqli_query($connection, $updateActualPendingAmount);

                            if ($queryUpdateActualPendingAmount) {

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

                                        $updateTotalBalance = "UPDATE `investors` SET `investors_account_balance` = '$newBalance', `investors_last_withdrawal` = '0.0' WHERE `investors_referral_link` = '$investor'";
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
                                            $message .= '<h1>Decline of Withdrawal, @ '.$name.'!</h1>';
                                            $message .= '<p>Your withdrawl of $'.$amount.' has been declined.</p>';
                                            $message .= '<p>Your total balance still remains $'.$newBalance.'.</p>';
                                            $message .= '<p>While the active balance and total earning is:.</p>';
                                            $message .= '<p>Your active balance is $'.$active.'.</p>';
                                            $message .= '<p>Your total earning balance is $'.$earning.'.</p>';
                                            $message .= '<p>Contact the admin through this link to know why: https://fortuneapex.com/contact.php</p>';
                                            $message .= '<p>Below is your link for your profile.</p>';
                                            $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                                            $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                                            $message .= '<p>Thanks for investing with us.</p>';
                                            $message .= '<p>From.</p>';
                                            $message .= '<p>FortuneApex Team</p>';
                                            $message .= '</body></html>';

                                            $subject = 'Declined Withdrawal Mail';
                                            $msg = wordwrap($message);
                                            $sendVerification = mail($email, $subject, $msg, $header);
                                            
                                            if ($sendVerification == true) {
                                                echo "
                                                <script>
                                                        alert(
                                                            'Successfully decline of withdrawal admin.'
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

                    // $selectNameAndEmailAddress = "SELECT `fullname`, `email_address`, `investors_account_balance`, `investors_active_deposit`, `investors_total_earning` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                    // $querySelectNameAndEmailAddress = mysqli_query($connection, $selectNameAndEmailAddress);

                    // if ($querySelectNameAndEmailAddress) {
                    //     while ($b = mysqli_fetch_assoc($querySelectNameAndEmailAddress)) {
                    //         $name = $b['fullname'];
                    //         $email = $b['email_address'];
                    //         $balance = $b['investors_account_balance'];
                    //         $active = $b['investors_active_deposit'];
                    //         $earning = $b['investors_total_earning'];

                    //         $newBalance = $balance;

                    //         $updateTotalBalance = "UPDATE `investors` SET `investors_account_balance` = '$newBalance', `investors_last_withdrawal` = '0.0' WHERE `investors_referral_link` = '$investor'";
                    //         $queryUpdateTotalBalance = mysqli_query($connection, $updateTotalBalance);

                    //         if ($queryUpdateTotalBalance) {
                    //             //  send user a mail for verification
                    //             $header = 'MIME-Version: 1.0' ."\r\n";
                    //             $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                    //             $from = 'info@fortuneapex.com';

                    //             $header.= 'From: '.$from."\r\n".
                    //             'Reply-To: '.$from."\r\n".
                    //             'X-Mailer: PHP/ '. phpversion();

                    //             $message = '<html><body>';
                    //             $message .= '<h1>Decline of Withdrawal, @ '.$name.'!</h1>';
                    //             $message .= '<p>Your withdrawl of $'.$amount.' has been declined.</p>';
                    //             $message .= '<p>Your total balance still remains $'.$newBalance.'.</p>';
                    //             $message .= '<p>While the active balance and total earning is:.</p>';
                    //             $message .= '<p>Your active balance is $'.$active.'.</p>';
                    //             $message .= '<p>Your total earning balance is $'.$earning.'.</p>';
                    //             $message .= '<p>Contact the admin through this link to know why: https://fortuneapex.com/contact.php</p>';
                    //             $message .= '<p>Below is your link for your profile.</p>';
                    //             $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                    //             $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                    //             $message .= '<p>Thanks for investing with us.</p>';
                    //             $message .= '<p>From.</p>';
                    //             $message .= '<p>FortuneApex Team</p>';
                    //             $message .= '</body></html>';

                    //             $subject = 'Declined Withdrawal Mail';
                    //             $msg = wordwrap($message);
                    //             $sendVerification = mail($email, $subject, $msg, $header);
                                
                    //             if ($sendVerification == true) {
                    //                 echo "
                    //                 <script>
                    //                         alert(
                    //                             'Successfully decline of withdrawal admin.'
                    //                         );
                    //                 </script>
                    //                     ";
                    //             }
                    //         }
                    //     }
                    // }
                }
            }
        }
    }
}
?>