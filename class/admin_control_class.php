<?php

class AdminControlClass{
    public function getInvestorCode($connection)
    {   
        if (isset($_GET['investor']) && !empty($_GET['investor'])) {
            $investorCode = filter_var(trim(mysqli_real_escape_string($connection, $_GET['investor'])), FILTER_SANITIZE_STRING);
            return $investorCode;
        } else{
            return false;
        }
    }

    public function suspendAccount($connection)
    {
        $investor = $this -> getInvestorCode($connection);

        $updateSuspendAccount = "UPDATE `investors` SET `suspendAccount` = '1' WHERE `investors_referral_link` = '$investor'";
        $queryUpdateSuspendAccount = mysqli_query($connection, $updateSuspendAccount);

        if ($queryUpdateSuspendAccount) {
            echo "
                <script>
                    alert(
                        'Successfully suspend of account.'
                    );
                </script>
                ";
        }
    }

    public function activateAccount($connection)
    {
        $investor = $this -> getInvestorCode($connection);

        $updateActivateAccount = "UPDATE `investors` SET `suspendAccount` = '0' WHERE `investors_referral_link` = '$investor'";
        $queryUpdateActivateAccount = mysqli_query($connection, $updateActivateAccount);

        if ($queryUpdateActivateAccount) {
            echo "
                <script>
                    alert(
                        'Successfully Activate of account.'
                    );
                </script>
                ";
        }
    }

    public function deleteAccount($connection)
    {
        $investor = $this -> getInvestorCode($connection);

        $updateDeleteAccount = "UPDATE `investors` SET `deleteAccount` = '1' WHERE `investors_referral_link` = '$investor'";
        $queryUpdateDeleteAccount = mysqli_query($connection, $updateDeleteAccount);

        if ($queryUpdateDeleteAccount) {
            echo "
            <script>
                    alert(
                        'Successfully delete of account.'
                    );
            </script>
                ";
        }
    }

    public function sendMessage($connection)
    {
        $investor = $this -> getInvestorCode($connection);

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
                $message .= '<h1>Message For not verifying account, @ '.$name.'!</h1>';
                $message .= '<p>It is noted to us that your account has not been verified.</p>';
                $message .= '<p>Don\'t forget you can see our frequent asked questions using the link https://fortuneapex.com/faq.php or you contact us using this link - https://fortuneapex.com/contact.php if you are in doubt.</p>';
                $message .= '<p>Below is your link for verifying your account.</p>';
                $message .= '<p style="text-color: #000000; text-decoration: none;"><a href="https://fortuneapex.com/investor_verification.php?investor='.$investor.'"></a>Click Me</p>';
                $message .= '<p>Copy - https://fortuneapex.com/investor_verification.php?investor='.$investor.'</p>';
                $message .= '<p>Thanks for joing our investors.</p>';
                $message .= '<p>From.</p>';
                $message .= '<p>FortuneApex Team</p>';
                $message .= '</body></html>';

                $subject = 'Email not verified';
                $msg = wordwrap($message);
                $sendVerification = mail($email, $subject, $msg, $header);
                
                if ($sendVerification == true) {
                    echo "
                    <script>
                            alert(
                                'Successfully not verifying mail sent, admin.'
                            );
                    </script>
                        ";
                }
            }
        }
    }
}
?>