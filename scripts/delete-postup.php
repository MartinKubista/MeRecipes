<?php

require_once "../scripts/connection.php";

if (isset($_GET['zmaz'])) {
    $id = $_GET["zmaz"];
    $id_recipe = $_GET["edit"];

    $record = mysqli_query($conn, "SELECT * FROM images WHERE id='$id'");           
    while($n = mysqli_fetch_array($record)){
        $img = $n['array_image'];
        $path = '../recipes-images/postup-images/'.$img;
        unlink($path);
    } 

    mysqli_query($conn, "DELETE FROM images WHERE id='$id'");
    
    header("location: ../pages/add-postup.php?edit=".$id_recipe);
}
?> 