<?php

require_once('../scripts/connection.php');

$msg = "";

if (isset($_POST['add-avatar'])) {
  $user = $_GET['user'];

  if (empty($_FILES["profile-photos"]["name"])) {
      header('Location: ../pages/page-add-avatar.php?user='.$user.'&message=Zadaj obrázok');
      exit;
  }

  $img = $_FILES["profile-photos"]["name"];
  $tempname = $_FILES["profile-photos"]["tmp_name"];    

  $folder = "../profile-photos/".$img;

  $query = "UPDATE users SET avatar = '$img' WHERE name = '$user'";
  mysqli_query($conn, $query);
  
  if (move_uploaded_file($tempname, $folder))  {
    $msg = "Obrázok sa podarilo nahrať";
  }
  else{
    $msg = "Nepodarilo sa nahrať obrázok";
  }

  header("location: ../pages/index.php");
}

?>