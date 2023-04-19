<?php

require_once('../scripts/connection.php');
$isEmpty = false;
$hasPasswordCertainLength = true;
$hasPasswordAtLeastOneNumber = true;
$usernameOrEmailAlreadyExists = false;

 
if (isset($_POST['change-password'])) {
    $user = $_GET['user'];
    $old = $_POST['old'];
    $new = $_POST['new'];

    if(empty($_POST["old"])){
        $isEmpty = true;
    }
    if(empty($_POST["new"])){
        $isEmpty = true;
    }
    if($isEmpty == true){
        header('Location: ../pages/page-change-password.php?user='.$user.'&message=Nieco si nezadal');

    }

    if (!preg_match("/[0-9]/", $new)) {
        $hasPasswordAtLeastOneNumber = false;
        header('Location: ../pages/page-change-password.php?user='.$user.'&message=Heslo musi obsahovat aspon jeden ciselny znak');
    }

    if(strlen($new) < 6){
        $hasPasswordCertainLength = false;
        header('Location: ../pages/page-change-password.php?user='.$user.'&message=Heslo musi obsahovat minimalne 6 znakov');
    }
    else{
        $hasPasswordCertainLength = true;
    }

    $result = mysqli_query($conn, "SELECT * FROM users WHERE name = '$user'");
    $row = mysqli_fetch_assoc($result);


    
    if( $row['password'] != $old){
        $usernameOrEmailAlreadyExists = true;
        header('Location: ../pages/page-change-password.php?user='.$user.'&message=Zadal si zlé staré heslo');

    }
    if( $row['password'] == $old){
        $usernameOrEmailAlreadyExists = false;
    }

    if( $isEmpty == false && $hasPasswordCertainLength && $hasPasswordAtLeastOneNumber == true && $usernameOrEmailAlreadyExists == false){
        $query = "UPDATE users SET password = '$new' WHERE name = '$user'";
        mysqli_query($conn, $query);
        header("location: ../pages/index.php");
    }   

    else{
        
    }

}

?>