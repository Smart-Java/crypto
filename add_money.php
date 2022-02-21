<?php 
session_start();
include_once ('./class/admin_account_class.php');
include_once ('./class/add_remove_money_class.php');
include_once ('./includes/connection_includes.php');
    
    $adminConnection = new AdminAccounClass();
    $investorSession = $adminConnection -> checkSession($connectionResult);
    $adminId = $adminConnection -> checkId($connectionResult);

    $name = $adminConnection -> getFullName($connectionResult);

    $information = '';
    
    if ($investorSession == true) {
        
        if (isset($_POST['addMoneyButtonId'])) {
            $amount = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['addMoneyId'])), FILTER_SANITIZE_STRING);
            $addMoney = new RemoveAddMoneyClass($amount);

            $result = $addMoney -> addMoney($connectionResult);
            $information = $result;
        }
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
    <style>
        .col-sm-0{
            display: none;
        }
        .col-md-0{
            display: none;
        }
    </style>
</head>


<body>
    <nav id="navbar" class="navbar navbar-light fixed-top justify-content-between" style="background-color:  #000; margin-bottom: 60px;">
        <a class="navbar-brand" href="#" style="color: #fff;">Add Money</a>
            <a class="d-lg-none d-sm-none d-md-none text-left logout" href="admin_logout.php" style="text-decoration: none;">
                <p data-toggle="collapse" data-target="#navbarMenu">
                    Logout
                </p>
            </a>
            <a href="admin_dashboard.php?admin=<?php echo $adminId;?>" class="d-lg-block d-sm-block d-md-block">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu" style="background-color: #FFA500;">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </a>
    </nav>

    <div>
        <div class="container-fluid">
            <div class="row" style="width: 100%; height: 1000px;">
                <div class="col-xl-4 col-sm-0 col-md-0" style="background-color: #000; border-color: #000; border: solid 1px;">
                    <div class="row">
                        <div class="container-fluid"  style="background-color: #000; width: 100%; height: 250px;">
                            <div class="text-center my-5">
                                <img src="user/pictures/admin.png" alt="admin.png" class="rounded-circle" style="color: #fff; margin-top: 20px;">
                            </div>
                            <div class="text-center">
                                <p style="color: #fff;">'.$name.'</p>
                            </div> 
                        </div> 
                    </div>
                    <div class="row">
                        <hr style="width: 100%; background-color: #FFA500;">
                    </div>
                    <div>
                        <ul class="list-group" style="background-color: #000; color: #fff;">
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="#" style="color: #FFA500; text-decoration: none;">Profile</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="annoucement_upload.php" style="color: white; text-decoration: none;">Account History</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="blog_upload.php" style="color: white; text-decoration: none;">Make Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Withdraw Deposit</a></li>
                            <li class="row text-capitalize font-weight-normal" style="margin-left: 10px; margin-bottom: 20px;"><a href="event_upload.php" style="color: white; text-decoration: none;">Account Settings</a></li>

                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-12 col-sm-12 col-md-12" style="margin-top: 70px;">
                    <div class="row">
                        <p class="text-left ml-4" style="text-transform: Uppercase; font-weight: bold;">Add Money</p>
                    </div>
                    <div class="row"style="margin-top: 0px;">
                        <p class="text-left ml-4" style="text-transform: Uppercase; font-weight: normal;"><?php echo $information;?></p>
                    </div>
                    <hr style="background-color: #000; height: 1.5; margin-top:0px;">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-12" style="background-color: #808090; border-radius: 10px; height: 50%; margin-left: 15px;">
                            <form class="row d-inline" method="post" action="add_money.php?admin=<?php echo $adminId;?>&investor=<?php echo $_GET['investor'];?>">
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col" style="margin-right: 50px;">Fullname: </p>
                                    <small class="col" style="width: 400px; font-weight: 500; font-size: 16px;"><?php echo $name;?></small></p>
                                </div>
                                <div class="row" style="margin-bottom: 10px; padding-left: 10px; padding-top: 10px; padding-right: 10px;">
                                    <p class="col"><label for="addMoneyId" style="margin-right: 50px;">Add money: </label></p>
                                    <input type="number" name="addMoneyId" id="addMoneyId" style="width: 400px;" class="col">
                                </div>
                                <div class="text-right">
                                    <input type="submit" value="Go" class="btn" name="addMoneyButtonId">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
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