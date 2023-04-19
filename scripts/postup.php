<?php

require_once('../scripts/connection.php');
require_once('../scripts/users.php');

$isEmpty = false;
$msg = "";
 
if (isset($_POST['add-postup'])) {
  $description = $_POST['description'];
  $recipe = $_POST['recipe_id'];
 
  $id = $_GET['edit'];

  $img = $_FILES["postup-images"]["name"];
  $tempname = $_FILES["postup-images"]["tmp_name"];    
  
  $folder = "../recipes-images/postup-images/".$img;



  $user = $_SESSION["account"]["name"];

  if(empty($description)){
    $isEmpty = true;
  }
  if($isEmpty == true){
    header("location: add-postup.php?message=Nieco si nezadal" && "locarion: add-postup.php?edit=".$id );


  }

  if($isEmpty == false){
  $query = "INSERT INTO images (recept_id, array_image, postup, username) VALUES('$recipe', '$img', '$description', '$user' )";
  mysqli_query($conn, $query);
  header("location: add-postup.php?edit=".$id);

  if (move_uploaded_file($tempname, $folder))  {
    $msg = "Obrázok sa podarilo nahrať";
  }
  else{
    $msg = "Nepodarilo sa nahrať obrázok";
  }
}
}

?>