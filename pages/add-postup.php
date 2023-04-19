<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/cfb876ecbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css"> 
    <title>Pridať postup</title>
</head>
<?php
   require_once('../scripts/connection.php');
   require_once ('../scripts/add_recipe.php');
   include('../parts/hlava.php');
?>
<body>
    <?php 
        require_once('../scripts/postup.php');

        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
        }
    ?>
    <div class="content">
    <?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
        <form action="" method="post" class="postup-prace" enctype="multipart/form-data">
            <fieldset>Postup receptu</fieldset>    
            <label for="file-input" class="file-input1">
                <i class="fa-solid fa-upload"></i>Vyber obrázok    
                <input type="file" id="file-input" accept="image/*" onchange="previewImage(this)" multiple="false" name="postup-images" value="">           
            </label>
            <script src="../scripts/show_image.js"></script>
            <img id="preview" src="" alt="" >
            <hr>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Popíš postup"></textarea>
            <input type="hidden" name="recipe_id" value="<?php echo $id; ?>">                                                  
            <p class="message"><?php echo $message ?></p>
            <div class="submit-container">
                 <button class="submit" name="add-postup">Pridať</button>
            </div>
        </form>
    </div>
    <div class="parent-pridanie-postupu">
        <?php $results = mysqli_query($conn, "SELECT * FROM images WHERE recept_id=$id"); ?>
            <ol class="pridavanie-postupu">
                <?php while ($row = mysqli_fetch_assoc($results)) { ?>              
                    <li>  
                        <a class="delete-link" href="../scripts/delete-postup.php?edit=<?php echo $id; ?>&zmaz=<?php echo $row["id"]; ?>">
                            <span class="material-symbols-outlined" style="color: red; ">close</span>
                        </a> 
                        
                        <?= $row["postup"] ?>
                        <br>
                        <img src="../recipes-images/postup-images/<?= $row["array_image"] ?>" alt="">                       
                    </li>
                    <br>              
                    <br>
                    <hr>
                    <br>
                    <br>
                <?php } ?>
            </ol>
    </div>
    <div class="index-return">
            <a href="index.php">
                <button>Návrat k receptom</button>
            </a>
    </div>
 <br>
 <br>
 <br>
 <br>
</body>
<?php
include('../parts/footer.php');
?>
</html>