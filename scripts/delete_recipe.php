<?php

require_once "../scripts/connection.php";

if (isset($_GET['delete'])) {
    $id = $_GET["delete"];

    $record = mysqli_query($conn, "SELECT * FROM recepty WHERE recept_id=$id");
	$n = mysqli_fetch_array($record);
    $img = $n['image_data'];
    $path = '../recipes-images/'.$img;
    unlink($path);

    $record2 = mysqli_query($conn, "SELECT * FROM images WHERE recept_id=$id");           
    while($n2 = mysqli_fetch_array($record2)){
        $img1 = $n2['array_image'];
        $path2 = '../recipes-images/postup-images/'.$img1;
        unlink($path2);
    } 

    mysqli_query($conn, "DELETE FROM recepty WHERE recept_id=$id");
    mysqli_query($conn, "DELETE FROM images WHERE recept_id=$id");
    
    header("location: ../pages/admin_page_recepty.php");
}

?> 