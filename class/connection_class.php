<?php
// the connection to the database

class ConnectionClass{
    public $host = 'localhost';
    public $database = 'crypto';
    public $user = 'root';
    public $password = '';
    public $connection = '';

    // emailpassword = admin$password1

    // public $host = 'localhost';
    // public $database = 'fortsgep_crypto_investment';
    // public $user = 'fortsgep_admin_crypto_investment';
    // public $password = '$fortuneapex1';
    // public $connection = '';
    // fortsgep_crypto_investment

    public function queryConnection()
    {

        $this-> connection = mysqli_connect($this-> host, $this-> user, $this -> password, $this-> database);

        
        return $this-> connection;
    }

    public function checkConnection()
    {
        $check = $this -> queryConnection();

        if($check){
            return true;
        } else{
            return false;
        }
    }
}
?>