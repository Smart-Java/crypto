<?php
session_start();

class AdminLoginClass{
    private $adminName;
    private $adminPin;

    public function __construct(String $name, String $pin_code) {
        $this->adminName = $name;
        $this->adminPin = $pin_code;
    }

    private function checkEmpty()
    {
        $aName = $this -> adminName;
        $aPinCode = $this -> adminPin;

        if (!empty($aName) && !empty($aPinCode)) {
            return true;
        } else{
            return false;
        }
    }

    private function checkAdmin($connection)
    {
        $admin = $this -> adminName;
        $adminPin = $this -> adminPin;

        $hashPin= md5(sha1(sha1(md5(md5(sha1(
            md5($adminPin)
        ))))));

        $queryAdmin = "SELECT `code`, `status` FROM `special_login` WHERE `admin_name` = '$admin' AND `admin_pin` = '$hashPin'";
        $runQueryAdmin = mysqli_query($connection, $queryAdmin);

        if ($runQueryAdmin) {
            $numRows = mysqli_num_rows($runQueryAdmin);
            if ($numRows == 1) {
                return $runQueryAdmin;
            } else{
                return false;
            }
        } else{
            return false;
        }
    }

    public function loginAdmin($connection)
    {
        $isEmpty = $this -> checkEmpty();
        $admin = $this -> checkAdmin($connection);
        
        if ($isEmpty == true) {
            if ($admin == false) {
                return 'It looks like you are not the admin.';
            } else{
                while ($a = mysqli_fetch_assoc($admin)) {
                    $code = $a['code'];
                    $status = $a['status'];

                    $_SESSION['admin'] = $code;

                    $url = 'admin_profile.php?admin='.$code;
                    
                    $updateStatus = "UPDATE `special_login` SET `status` = '1' WHERE `code` = '$code'";
                    $queryUpdateStatus = mysqli_query($connection, $updateStatus);
                    if ($queryUpdateStatus) {
                        header('Location: '.$url);
                    }

                    // if ($status == 1) {
                    //     $updateStatus = "UPDATE `special_login` SET `isDisable` = '1' WHERE `code` = '$code'";
                    //     $queryUpdateStatus = mysqli_query($connection, $updateStatus);
                    //     if ($queryUpdateStatus) {
                    //         return 'This account has been disable <br> because either a hacker or someone tries loging in.';
                    //     }
                    // } else{
                    //     $_SESSION['admin'] = $code;

                    //     $url = 'admin_profile.php?admin='.$code;
                        
                    //     $updateStatus = "UPDATE `special_login` SET `status` = '1' WHERE `code` = '$code'";
                    //     $queryUpdateStatus = mysqli_query($connection, $updateStatus);
                    //     if ($queryUpdateStatus) {
                    //         header('Location: '.$url);
                    //     }
                    // }
                }
            }
        } else{
            return 'One of the field is empty.';
        }
    }
}

?>