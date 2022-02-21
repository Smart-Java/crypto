<?php
session_start();
include_once ('./class/user_account_class.php');
include_once ('./includes/connection_includes.php');

$userAccount = new UserAccountClass();

if ($userAccount -> checkedSession($connectionResult) == true) {
    $userName = $userAccount -> getUsername($connectionResult);
    $investorCode = $userAccount -> getReferralCode($connectionResult);
    $userName = $userAccount-> getUsername($connectionResult);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    
    <link rel="stylesheet" href="user/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="user/bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="user/css/logout.css">
    <!-- <link rel="stylesheet" href="user/bootstrap/css/admin_profile.css"> -->

    <link rel="icon" type="image/png" sizes="32x32" href="user/images/favicon.png">
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage:'en'},
            'google_translate_element'
            );
        }
    </script>

    <title><?php echo $userName;?></title>
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 70px;">
        <a class="navbar-brand" href="user_profile.php?investor=<?php echo $investorCode;?>" style="color: #fff;"><?php echo $userName?></a>
        
        <!-- logout of the admin -->
        <a class="text-left logout" href="./logout.php?investor=<?php echo $investorCode;?>" style="text-decoration: none;">
            <p data-toggle="collapse" data-target="#navbarMenu">
                Logout
            </p>
        </a>
    </nav>

    <!-- the admin dashboard on mobile view -->
    <div class="card" style="margin-top: 55px;">
    <div id="google_translate_element" style="text-align: right;">
                
    </div>

        <ul class="list-group list-group-flush">
          <a href="user_profile.php?investor=<?php echo $investorCode;?>" class="list-group-item row list-group-item-action">
            <li class="col">Profile</li>
          </a>
          <a href="account_history.php?investor=<?php echo $investorCode;?>" class="list-group-item row list-group-item-action">
            <li class="col">Account History</li>
          </a>
          <a href="make_deposit.php?investor=<?php echo $investorCode;?>" class="list-group-item row list-group-item-action">
            <li class="col">Make Deposit</li>
          </a>
          <a href="withdraw_deposit.php?investor=<?php echo $investorCode;?>" class="list-group-item row list-group-item-action">
            <li class="col">Withdraw Deposit</li>
          </a> 
          <a href="account_setting.php?investor=<?php echo $investorCode;?>" class="list-group-item row list-group-item-action">
            <li class="col">Account Settings</li>
          </a>
        </ul>
      </div>   
    <script src="user/bootstrap/js/jquery.js" integrity="sha384q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
    <script src="user/bootstrap/js/popper.js"></script>
    <script src="user/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="user/bootstrap/js/bootstrap.js"></script>
</body>
</html>
<?php
}else{
  header('Location: login.php');
}
?>