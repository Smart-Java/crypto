<?php
include_once ('../class/refresh_class.php');
include_once ('../includes/connection_includes.php');

$refreshRecords = new RefreshClass();
$refreshRecords->updateRecords($connectionResult);

header('Refresh: 1800');
?>