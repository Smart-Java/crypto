
    <?php
        include_once ('./includes/connection_includes.php');
        $data = "SELECT `fullname` FROM `investors` WHERE `status` = '1' ORDER BY `investors_id` DESC";
        $queryData = mysqli_query($connectionResult, $data);

        if ($queryData) {
            // $userName = [];
            while ($a = mysqli_fetch_assoc($queryData)) {
                // $userName[] = $a;
                $b[] = $a;
                $userName['Fullname'] = $b;
                  
            }
            $result = json_encode($userName); 
            echo   $result;
        }
    ?>