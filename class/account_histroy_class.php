<?php


class AccountHistory{

    private $transactionType;
    private $fromDate;
    private $endDate;
    
    public function __construct($type, $from, $to) {
        $this->fromDate = $from;
        $this->transactionType = $type;
        $this->endDate = $to;
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

    public function getDepositTransaction($connection)
    {
        # code...
    }
}
?>