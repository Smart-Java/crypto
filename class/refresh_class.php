<?php

// 1. select the plans, amountDeposited, and referral_code that deposit has been approved
// 2. calculate the profit to each plans in respective of its plan time
// 3. update the profit to the total earning and account balance of the investor_referral_code
// 4. use php header function to refresh the page
class RefreshClass{
    public function updateRecords($connection)
    {
        date_default_timezone_set("America/New_York");
        $selectDepositDetails = "SELECT `transaction_plan`, `amount`, `investor_referral_code`, `time` FROM `deposittransaction` WHERE `is_transaction_approved` = '1' AND `isTimeSet` = '1'";
        $queryDepositDetails = mysqli_query($connection, $selectDepositDetails);

        if ($queryDepositDetails) {
            
            $numRows = mysqli_num_rows($queryDepositDetails);

            echo "
                    <script>
                        alert('".$numRows."');
                        // alert('time".time()."');
                        // alert('time".strtotime('now')."');
                    </script>
                ";

            while ($a = mysqli_fetch_assoc($queryDepositDetails)) {
                
                $plan = $a['transaction_plan'];
                $amountDeposited = $a['amount'];
                $referral_code = $a['investor_referral_code'];
                $timeFromDatabase = $a['time'];

                $now = time();

                if ($plan == "Stage 1") {
                    $updateTimePlanOne = strtotime(date('h:i:s a', strtotime('+24 hours', strtotime(date(
                        'h:i:s a', $timeFromDatabase
                    )))));

                    $dateDiffPlanOne = $updateTimePlanOne - $now;

                    $currentDiffPlanOne = round($dateDiffPlanOne/(60 * 60 * 24));

                    $durationPlanOne = (60 * 60 * 24);

                    // echo "
                    // <script>
                    //     alert('the time diff to update for plan 1 is ".$dateDiffPlanOne."');
                    // </script>
                    // ";

                    if ($durationPlanOne >= $dateDiffPlanOne) {
                        $profit = round((0.0625 * $amountDeposited) / 100);
                    } else{
                        $profit = 0;
                    }
                }

                if ($plan == "Stage 2") {
                    $updateTimePlanTwo = strtotime(date('h:i:s a', strtotime('+36 hours', strtotime(date(
                        'h:i:s a', $timeFromDatabase
                    )))));

                    $dateDiffPlanTwo = $updateTimePlanTwo - $now;
                    $currentDiffPlanTwo = round($dateDiffPlanTwo/(60 * 60 * 36));

                    $durationPlanTwo = (60 * 60 * 36);

                //     echo "
                //     <script>
                //         alert('the time diff to update for plan 2 is ".$dateDiffPlanTwo."');
                //     </script>
                // ";

                    if ($durationPlanTwo >= $dateDiffPlanTwo) {
                        $profit = round((0.016203 * $amountDeposited) / 100);
                    } else{
                        $profit = 0;
                    }
                }


                $selectInvestorDetails = "SELECT `investors_total_earning`, `investors_account_balance` FROM `investors` WHERE `investors_referral_link` = '$referral_code'";
                $querySelectInvestorDetails = mysqli_query($connection, $selectInvestorDetails);

                if ($querySelectInvestorDetails) {
                    while ($b = mysqli_fetch_assoc($querySelectInvestorDetails)) {
                        $totalEarning = $b['investors_total_earning'];
                        $accountBalance = $b['investors_account_balance'];

                        $newTotalEarning = $totalEarning + $profit;
                        $newAccountBalance = $accountBalance + $profit;

                        $updateInvestorAccount = "UPDATE `investors` SET `investors_total_earning` = '$newTotalEarning', `investors_account_balance` = '$newAccountBalance' WHERE `investors_referral_link` = '$referral_code'";
                        $queryUpdateInvestorAccount = mysqli_query($connection, $updateInvestorAccount);

                //         echo "
                //     <script>
                //         alert('".$newAccountBalance."');
                //         // alert('time".time()."');
                //         // alert('time".strtotime('now')."');
                //     </script>
                // ";
                    }
                }
            }
        }
    }
}
?>