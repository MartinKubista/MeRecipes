<?php
session_start();
  
require_once "../scripts/connection.php";

$error = [
    "form" => false,
    "name" => false,
    "password" => false,
];

if(isset($_POST["login_user"])){
    $name = $_POST["name"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";    
    $results = mysqli_query($conn, $query);
    $n = mysqli_fetch_array($results);

    if (mysqli_num_rows($results) == 1) {
        $_SESSION["account"] = [
            "name" => $_POST["name"],
            "password" => $_POST["password"],
            "user_type" => $n['user_type'],
        ];
        header("location: index.php");
    }

    else {
        $error["form"] = true;
    }

    if(!$name) {
        $error["name"] = true;
    }
    else {
        $error["name"] = false;
    }

    if(!$password) {
        $error["password"] = true;
    }
    else {
        $error["password"] = false;
    }
}

?>