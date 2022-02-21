<?php 
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./includes/connection_includes.php');

    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);
    $investorId = $adminConnection -> checkId($connectionResult);

    if ($investorSession == true) {
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

    <title></title>
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 70px;">
        <a class="navbar-brand" href="#" style="color: #fff;">Adminstrator</a>
        
        <!-- logout of the admin -->
        <a class="text-left logout" href="admin_logout.php?admin=<?php echo $investorId;?>" style="text-decoration: none;">
            <p data-toggle="collapse" data-target="#navbarMenu">
                Logout
            </p>
        </a>
    </nav>

    <!-- the admin dashboard on mobile view -->
    <div class="card" style="margin-top: 55px;">

        <ul class="list-group list-group-flush">
        <a href="admin_profile.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Administrator Profile</li>
          </a>
          <a href="admin_page.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Investors</li>
          </a>
          <a href="approved_deposit.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Approved Deposit Amount</li>
          </a>
          <a href="approved_withdrawal.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Approved Withdrawal Amount</li>
          </a>
          <a href="pending_deposit.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Pending Deposit Amount</li>
          </a> 
          <a href="pending_withdrawal.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Pending Withdrawal Amount</li>
          </a>
          <a href="admin_setting.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Admin Setting</li>
          </a>
          <a href="activate_accounts.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Activate Account</li>
          </a>
          <a href="transactions.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Transactions</li>
          </a>
          <a href="referrals_table.php?admin=<?php echo $investorId;?>" class="list-group-item row list-group-item-action">
            <li class="col">Referral Table</li>
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