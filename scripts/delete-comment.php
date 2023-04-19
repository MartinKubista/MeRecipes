<?php

require_once "../scripts/connection.php";

if (isset($_GET['zmaz'])) {
    $id = $_GET["zmaz"];
    $id_recipe = $_GET["edit"];

    mysqli_query($conn, "DELETE FROM reviews WHERE id='$id'");
    
    header("location: ../pages/recipe.php?recipe=".$id_recipe);
}
?> 