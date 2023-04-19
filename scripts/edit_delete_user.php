<?php

require_once "../scripts/connection.php";

if (isset($_GET['delete']) && isset($_GET['user'])) {
    $id = $_GET["delete"];
    $user = $_GET["user"];

    $record = mysqli_query($conn, "SELECT * FROM recepty WHERE username='$user'");
	$n = mysqli_fetch_array($record);
    $img = $n['image_data'];
    $path = '../recipes-images/'.$img;
    unlink($path);

    $record2 = mysqli_query($conn, "SELECT * FROM images WHERE username='$user'");           
    while($n2 = mysqli_fetch_array($record2)){
        $img1 = $n2['array_image'];
        $path2 = '../recipes-images/postup-images/'.$img1;
        unlink($path2);
    } 

    mysqli_query($conn, "DELETE FROM recepty WHERE username='$user'");
    mysqli_query($conn, "DELETE FROM images WHERE username='$user'");
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    mysqli_query($conn, "DELETE FROM reviews WHERE username='$user'");

    header("location: ../pages/admin_page_pouzivatelia.php");
}
 
if (isset($_GET['user'])) {
    $user = $_GET["user"];

    $record = mysqli_query($conn, "SELECT users.user_type FROM users WHERE name ='$user'");
    $row = mysqli_fetch_assoc($record);
    $user_type = $row['user_type'];
    if($user_type == "admin"){
        mysqli_query($conn, "UPDATE users SET user_type = 'user' WHERE name='$user'");

    }
    else if($user_type == "user"){
        mysqli_query($conn, "UPDATE users SET user_type = 'admin' WHERE name='$user'");

    }
    
    header("location: ../pages/admin_page_pouzivatelia.php");
}

?> 