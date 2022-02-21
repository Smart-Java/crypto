<?php

class TransactionMessageClass{
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
    
    public function getDepositCode($connection)
    {   
        if (isset($_GET['depositCode']) && !empty($_GET['depositCode'])) {
            $depositCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['depositCode'])), FILTER_SANITIZE_STRING);
            return $depositCode;
        } else{
            return false;
        }
    }

    public function messageWithdrawal($connection)
    {
        $investor = $this->getInvestorCode($connection);

        $withdraw = $this -> getWithdrawalCode($connection);

        $selectAmount = "SELECT `withdraw_amount` FROM `withdraw_deposit` WHERE `withdraw_investor_code` = '$investor' AND `withdraw_code` = '$withdraw'";
        $querySelectAmount = mysqli_query($connection, $selectAmount);

        if ($querySelectAmount) {
            while ($a = mysqli_fetch_assoc($querySelectAmount)) {
                $amount = $a['withdraw_amount'];

                $selectNameAndEmailAddress = "SELECT `fullname`, `email_address` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                $querySelectNameAndEmailAddress = mysqli_query($connection, $selectNameAndEmailAddress);

                if ($querySelectNameAndEmailAddress) {
                    while ($b = mysqli_fetch_assoc($querySelectNameAndEmailAddress)) {
                        $name = $b['fullname'];
                        $email = $b['email_address'];

                        $header = 'MIME-Version: 1.0' ."\r\n";
                        $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                        $from = 'info@fortuneapex.com';

                        $header.= 'From: '.$from."\r\n".
                        'Reply-To: '.$from."\r\n".
                        'X-Mailer: PHP/ '. phpversion();

                        $message = '<html><body>';
                        $message .= '<h1>Message For pending withdrawal, @ '.$name.'!</h1>';
                        $message .= '<p>Your withdrawal of $'.$amount.' has can\'t be approved.</p>';
                        $message .= '<p>The reason you can find in our frequent asked questions using the link - https://fortuneapex.com/faq.php or you contact us using this link - https://fortuneapex.com/contact.php.</p>';
                        $message .= '<p>Below is your link for your profile.</p>';
                        $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                        $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                        $message .= '<p>Thanks for investing with us.</p>';
                        $message .= '<p>From.</p>';
                        $message .= '<p>FortuneApex Team</p>';
                        $message .= '</body></html>';

                        $subject = 'Reason For Pending Withdrawl Mail';
                        $msg = wordwrap($message);
                        $sendVerification = mail($email, $subject, $msg, $header);
                        
                        if ($sendVerification == true) {
                            echo "
                            <script>
                                    alert(
                                        'Successfully pending withdrawl mail sent, admin.'
                                    );
                            </script>
                                ";
                        }
                    }
                }
            }
        }
    }

    public function messageDeposit($connection)
    {
        $investor = $this->getInvestorCode($connection);

        $deposit = $this -> getDepositCode($connection);

        $selectAmount = "SELECT `amount` FROM `deposittransaction` WHERE `investor_referral_code` = '$investor' AND `transaction_code` = '$deposit'";
        $querySelectAmount = mysqli_query($connection, $selectAmount);

        if ($querySelectAmount) {
            while ($a = mysqli_fetch_assoc($querySelectAmount)) {
                $amount = $a['amount'];

                $selectNameAndEmailAddress = "SELECT `fullname`, `email_address` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                $querySelectNameAndEmailAddress = mysqli_query($connection, $selectNameAndEmailAddress);

                if ($querySelectNameAndEmailAddress) {
                    while ($b = mysqli_fetch_assoc($querySelectNameAndEmailAddress)) {
                        $name = $b['fullname'];
                        $email = $b['email_address'];
                            
                        $header = 'MIME-Version: 1.0' ."\r\n";
                        $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

                        $from = 'info@fortuneapex.com';

                        $header.= 'From: '.$from."\r\n".
                        'Reply-To: '.$from."\r\n".
                        'X-Mailer: PHP/ '. phpversion();

                        $message = '<html><body>';
                        $message .= '<h1>Message For pending deposit, @ '.$name.'!</h1>';
                        $message .= '<p>Your deposit of $'.$amount.' has can\'t be approved.</p>';
                        $message .= '<p>The reason you can find in our frequent asked questions using the link https://fortuneapex.com/faq.php or you contact us using this link - https://fortuneapex.com/contact.php.</p>';
                        $message .= '<p>Below is your link for your profile.</p>';
                        $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                        $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                        $message .= '<p>Thanks for investing with us.</p>';
                        $message .= '<p>From.</p>';
                        $message .= '<p>FortuneApex Team</p>';
                        $message .= '</body></html>';

                        $subject = 'Reason For Pending Deposit Mail';
                        $msg = wordwrap($message);
                        $sendVerification = mail($email, $subject, $msg, $header);
                        
                        if ($sendVerification == true) {
                            echo "
                            <script>
                                    alert(
                                        'Successfully pending deposit mail sent, admin.'
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
?>