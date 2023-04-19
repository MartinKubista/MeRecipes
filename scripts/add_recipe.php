<?php

require_once "../scripts/connection.php";
require_once('../scripts/users.php');

$msg = "";
$isEmpty = false;
$receptAlreadyExists = false;

if (isset($_POST['vytvor_recept'])) {

  $title = $_POST['nazov-receptu'];
  $content = $_POST['popis-receptu'];
  $suroviny = $_POST['suroviny'];
  $options = $_POST['options'];
  $priprava = $_POST['priprava-v-minutach'];
  $varenie = $_POST['varenie-pecenie'];
  $teplota = $_POST['teplota'];
  $porcie = $_POST['pocet-porci'];
  $link = $_POST['link'];

  $parsed_url = parse_url($link);
  parse_str($parsed_url["query"], $query);
  $video_id = $query["v"];

  $user = $_SESSION["account"]["name"];

  $img = $_FILES["recipes-images"]["name"];
  $tempname = $_FILES["recipes-images"]["tmp_name"];    
  $folder = "../recipes-images/".$img;

  $sql_e = "SELECT * FROM recepty WHERE nazov_receptu='$title'";
  $res_e = mysqli_query($conn, $sql_e);

if(mysqli_num_rows($res_e) > 0){
    $receptAlreadyExists = true;
    header('Location: ../pages/add-recipe.php?message=Zadaj iný názov receptu');
}

  if(empty($_POST["nazov-receptu"])){
    $isEmpty = true;
  }
  if(empty($_POST["popis-receptu"])){
      $isEmpty = true;
  }
  if(empty($_POST["suroviny"])){
    $isEmpty = true;
  }
  if(empty($_POST["options"])){
      $isEmpty = true;
  }
  if($isEmpty == true){
    header('Location: ../pages/add-recipe.php?message=Niečo si nezadal');
}
  if($isEmpty == false && $receptAlreadyExists == false){
  $query = "INSERT INTO recepty (nazov_receptu, popis_receptu, suroviny, options, priprava_v_minutach,varenie_pecenie,teplota,pocet_porci,image_data, username, date_of_create, new_old, link) VALUES('$title', '$content', '$suroviny', '$options', '$priprava','$varenie','$teplota','$porcie', '$img', '$user',CURRENT_TIMESTAMP, 'new', '$video_id')";
  mysqli_query($conn, $query);
  
  if (move_uploaded_file($tempname, $folder))  {
    $msg = "Obrázok sa podarilo nahrať";
  }
  else{
    $msg = "Nepodarilo sa nahrať obrázok";
  }

  $results = mysqli_query($conn, "SELECT recept_id FROM recepty WHERE nazov_receptu='$title'");
  $row = mysqli_fetch_array($results);
  $id = $row['recept_id'];
  header("location: ../pages/add-postup.php?edit=".$id);
  }

}

?>