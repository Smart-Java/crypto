<?php
/*
this is the include file of the connection class
*/
if($_SERVER['SCRIPT_NAME'] == '/includes/refresh_includes.php'){
    include_once ('../class/connection_class.php');   
} else{
    include_once ('./class/connection_class.php');
}

$connection = new ConnectionClass();

$connectionResult = $connection->queryConnection();

$checkConnection = $connection->checkConnection();


$time = date('h:i:s');
$realTime = strtotime($time, strtotime('30minutes'));

if ($checkConnection == true) {
    // include_once ('../includes/refresh_includes.php');
    include_once ('./class/refresh_class.php');
}


$scriptName = $_SERVER['SCRIPT_NAME'];

$cryptoUrl = 'localhost/crypto/';
$cryptoUrl = 'https://fortuneapex.com/';

?>
<script>
    function disable_f5(e)
    {
        if ((e.which || e.keyCode) == 116)
    {
        e.preventDefault();
    }
    }

    $(document).ready(function(){
        $(document).bind("keydown", disable_f5);    
    });
</script>