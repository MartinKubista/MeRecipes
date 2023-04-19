<?php

require_once "../scripts/connection.php";
require_once('../scripts/users.php');

$msg = "";

if (isset($_POST['add-review'])) {
  $review = $_POST['review'];
  $username = $_POST['username'];
  $recept_id = $_POST['recept_id'];

  $query = "INSERT INTO reviews (review, username, datetime, recept_id) VALUES('$review', '$username', CURRENT_TIMESTAMP, '$recept_id')";
  mysqli_query($conn, $query);

  header("location: ../pages/recipe.php?recipe=".$recept_id);
}

?>