<?php
require_once('../scripts/connection.php');
$isEmpty = false;
$hasPasswordCertainLength = true;
$hasPasswordAtLeastOneNumber = true;
$passwordAreSame = true;
$usernameOrEmailAlreadyExists = false;


$username = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(empty($_POST["email"])){
    $isEmpty = true;
}
if(empty($_POST["name"])){
    $isEmpty = true;
}
if(empty($_POST["password"])){
    $isEmpty = true;
}
if(empty($_POST["password-r"])){
    $isEmpty = true;
}
if($isEmpty == true){
    echo "Nieco si nezadal" . "<br>";
}

if (!preg_match("/[0-9]/", $password)) {
    $hasPasswordAtLeastOneNumber = false;
    header('Location: ../pages/register.php?message=Heslo musi obsahovat aspon jeden ciselny znak');
}

$_SESSION['em'] = $_POST['email'];
$_SESSION['user'] = $_POST['name'];
$_SESSION['pass'] = $_POST['password'];


if($_POST["password"] == $_POST["password-r"]){
    $passwordAreSame = true;
}
else{
    $passwordAreSame = false;
    header('Location: ../pages/register.php?message=Hesla sa nezhoduju');
}

if(strlen($password) < 6){
    $hasPasswordCertainLength = false;
    header('Location: ../pages/register.php?message=Heslo musi obsahovat minimalne 6 znakov');
}
else{
    $hasPasswordCertainLength = true;
}


$sql_e = "SELECT * FROM users WHERE email='$email'";
$res_e = mysqli_query($conn, $sql_e);
$sql_u = "SELECT * FROM users WHERE name='$username'";
$res_u = mysqli_query($conn, $sql_u);



if(mysqli_num_rows($res_e) > 0){
    $usernameOrEmailAlreadyExists = true;
    header('Location: ../pages/register.php?message=Email uz bol pouzity');
}
if(mysqli_num_rows($res_u) > 0){
    $usernameOrEmailAlreadyExists = true;
    header('Location: ../pages/register.php?message=Uzivatelske meno je uz obsadene');
}
if($isEmpty == false && $hasPasswordCertainLength && $hasPasswordAtLeastOneNumber == true && $passwordAreSame == true && $usernameOrEmailAlreadyExists == false){
    $sql = "INSERT INTO users (name, email, password) 
    VALUES('$username', '$email', '$password')";
    if ($conn->query($sql) == true){       
        header('Location: ../pages/login.php?message=Registracia bola uspesna');
    }
    else{
        echo "Error" . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>