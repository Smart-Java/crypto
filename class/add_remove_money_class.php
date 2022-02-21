<?php

class RemoveAddMoneyClass{
    private $amount;

    public function __construct($amt) {
        $this->amount = $amt;
    }

    private function checkIfEmpty()
    {
        if (!empty($this->amount)) {
            return true;
        } else{
            return false;
        }
    }

    private function checkVaildAmount()
    {
        $amountToTrans = $this->amount;
        if ($amountToTrans >=1) {
            return true;
        } else{
            return false;
        }
    }

    public function getInvestorCode($connection)
    {   
        if (isset($_GET['investor']) && !empty($_GET['investor'])) {
            $investorCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);
            return $investorCode;
        } else{
            return false;
        }
    }

    public function addMoney($connection)
    {
        $investor = $this->getInvestorCode($connection);

        $isNotEmpty = $this->checkIfEmpty();
        $isVaildToTrans = $this->checkVaildAmount();

        $amountToPay = $this->amount;

        if ($isNotEmpty == true) {
            if ($isVaildToTrans == true) {
                $selectTotal= "SELECT `fullname`, `email_address`, `investors_account_balance` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                $querySelectTotal= mysqli_query($connection, $selectTotal);

                if ($querySelectTotal) {
                    while ($b = mysqli_fetch_assoc($querySelectTotal)) {
                        $name = $b['fullname'];
                        $email = $b['email_address'];
                        $balance = $b['investors_account_balance'];

                        $newBalance = $balance + $amountToPay;

                        $updateTotalBalance = "UPDATE `investors` SET `investors_account_balance` = '$newBalance' WHERE `investors_referral_link` = '$investor'";
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
                            $message .= '<h1>Successful payment, @ '.$name.'!</h1>';
                            $message .= '<p>Your have recieved $'.$amountToPay.' from the company.</p>';
                            $message .= '<p>Your total balance is $'.$newBalance.'.</p>';
                            $message .= '<p>Below is your link of your profile.</p>';
                            $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                            $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                            $message .= '<p>Thanks for investing with us.</p>';
                            $message .= '<p>From.</p>';
                            $message .= '<p>FortuneApex Team</p>';
                            $message .= '</body></html>';

                            $subject = 'Credit Message';
                            $msg = wordwrap($message);
                            $sendVerification = mail($email, $subject, $msg, $header);
                            
                            if ($sendVerification == true) {
                                echo "
                                <script>
                                        alert(
                                            'Amount Added successfully, admin.'
                                        );
                                </script>
                                    ";
                            }
                        }
                    }
                }
            } else{
                return 'You can not add invalid amount to an investor';
            }  
        } else{
            return 'The amount field is empty, admin';
        }
    }

    public function removeAmount($connection)
    {
        $investor = $this->getInvestorCode($connection);

        $isNotEmpty = $this->checkIfEmpty();
        $isVaildToTrans = $this->checkVaildAmount();

        $amountToRemove = $this->amount;

        if ($isNotEmpty == true) {
            if ($isVaildToTrans == true) {
                $selectTotal= "SELECT `fullname`, `email_address`, `investors_account_balance` FROM `investors` WHERE `investors_referral_link` = '$investor'";
                $querySelectTotal= mysqli_query($connection, $selectTotal);

                if ($querySelectTotal) {
                    while ($b = mysqli_fetch_assoc($querySelectTotal)) {
                        $name = $b['fullname'];
                        $email = $b['email_address'];
                        $balance = $b['investors_account_balance'];

                        $newBalance = $balance - $amountToRemove;

                        $updateTotalBalance = "UPDATE `investors` SET `investors_account_balance` = '$newBalance' WHERE `investors_referral_link` = '$investor'";
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
                            $message .= '<h1>Successful Withdrawal, @ '.$name.'!</h1>';
                            $message .= '<p>Your have been debited of $'.$amountToRemove.' from the company.</p>';
                            $message .= '<p>Your total balance is $'.$newBalance.'.</p>';
                            $message .= '<p>Below is your link of your profile.</p>';
                            $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/user_profile.php?investor='.$investor.'"></a>Click Me</p>';
                            $message .= '<p>Copy - https://fortuneapex.com/user_profile.php?investor='.$investor.'</p>';
                            $message .= '<p>Thanks for investing with us.</p>';
                            $message .= '<p>From.</p>';
                            $message .= '<p>FortuneApex Team</p>';
                            $message .= '</body></html>';

                            $subject = 'Debit Message';
                            $msg = wordwrap($message);
                            $sendVerification = mail($email, $subject, $msg, $header);
                            
                            if ($sendVerification == true) {
                                echo "
                                <script>
                                        alert(
                                            'Amoun Removed successfully, admin.'
                                        );
                                </script>
                                    ";
                            }
                        }
                    }
                }
            } else{
                return 'You can not add invalid amount to an investor';
            }  
        } else{
            return 'The amount field is empty, admin';
        }
    }
}

?>