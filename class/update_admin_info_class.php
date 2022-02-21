<?php

class UpdateAdminInfoClass{
    private $adminName;
    private $adminPin;
    private $adminConfirmPin;

    public function __construct(String $name, String $pin, String $confirmPin) {
        $this->adminName = $name;
        $this->adminPin = $pin;
        $this->adminConfirmPin = $confirmPin;
    }

    private function checkedIfEmpty()
    {
        if (!empty($this->adminName) && !empty($this->adminPin) && !empty($this->adminConfirmPin)) {
            return true;
        } else{
            return false;
        }
    }

    private function checkedMatchedPassword()
    {
        $pin = $this -> adminPin;
        $confirmPin = $this -> adminConfirmPin;

        if ($pin == $confirmPin) {
            return true;
        } else{
            return false;
        }
    }

    public function getAdminCode()
    {
        if (!empty($_SESSION['admin'])) {
            return $_SESSION['admin'];
        } else{
            return false;
        }
    }

    public function updateAdminInfo($connection)
    {
        $administratorName = $this -> adminName;
        $administratorPin = $this -> adminPin;
        
        $isNotEmpty = $this-> checkedIfEmpty();
        $code = $this-> getAdminCode();
        $matchedPassword = $this->checkedMatchedPassword();

        $hashPin= md5(sha1(sha1(md5(md5(sha1(
            md5($administratorPin)
        ))))));

        if ($isNotEmpty == true) {
            if ($matchedPassword == true) {
                $updateInfo = "UPDATE `special_login` SET `admin_name` = '$administratorName' , `admin_pin` = '$hashPin' WHERE `code` = '$code'";
                $queryUpdateInfo = mysqli_query($connection, $updateInfo);
                if ($queryUpdateInfo) {
                    return 'Success update of info';
                } else{
                    return 'Update of info failed';
                }
            } else{
                return 'Pins mismatched, Admin';
            }
        } else{
            return 'You can\'t update an anonymous info';
        }
    }
}
?>