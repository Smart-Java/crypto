<?php

$hostName = 'localhost';
$databaseUsername = "root";
$databasePassword = "";
$database = "database_test";

$connect  = mysqli_connect($hostName, $databaseUsername, 
$databasePassword, $database);

if ($connect) {
    echo 'success';
} else{
    echo 'fail';
}

if (isset($_POST['submitId'])) {
    $email = $_POST['emailId'];
    $password = $_POST['passwordId'];
    $confirmPassword = $_POST['confirmPasswordId'];

    if (!empty($email) && !empty($password) && !empty($confirmPassword)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($password) >= 7) {
                if ($password == $confirmPassword) {
                    //  upload user record
                    $insertUser = "INSERT `users`
                    (
                        `id`, 
                        `email`,
                        `password`
                    )
                        VALUES
                        (
                            '',
                            '$email',
                            '$password'
                        )
                    ";
                    $queryInsertUser = mysqli_query($connect, $insertUser);
                    if ($queryInsertUser) {
                        echo 'Successfully registration';
                    } else{
                        echo 'Failed, try again';
                    }
                } else{
                    echo 'Mismatch of password';
                }
            } else{
                echo 'password length is small';
            }
        } else{
            echo 'Wrong email';
        }
    } else{
        echo 'One of the fields is empty';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test_login.php" method="post">
        <input type="text" name="emailId" id="emailId">
        <input type="text" name="passwordId" id="passwordId">
        <input type="text" name="confirmPasswordId" id="confirmPasswordId">
        <input type="submit" value="Submit" name="submitId">
    </form>
</body>
</html>