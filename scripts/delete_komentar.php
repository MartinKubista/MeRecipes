<?php

require_once "../scripts/connection.php";

if (isset($_GET['zmaz'])) {
    $id = $_GET["zmaz"];

    mysqli_query($conn, "DELETE FROM reviews WHERE id='$id'");
    
    header("location: ../pages/admin_page_komentare.php");
}
?> 