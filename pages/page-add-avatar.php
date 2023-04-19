<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cfb876ecbd.js" crossorigin="anonymous"></script>
    <title>Profil</title>
</head>
<body>

    <?php
        require_once('../scripts/connection.php');
        require_once('../scripts/users.php');
        include('../parts/hlava.php');
        require_once('../scripts/add-avatar.php');   
        require_once('../scripts/change-password.php');   

        if (isset($_GET['user'])) {
            $user = $_GET['user'];
        }
    ?>

    <div class="content">
        <?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
                <div class="container_profile_img">
                    <div class="forms">
                        <form action="" method="post" class="profile" enctype="multipart/form-data">
                            <fieldset>Profilová fotka</fieldset>    
                            <p class="message"><?php echo $message ?></p>

                            <label for="file-input" class="file-input1">
                                <i class="fa-solid fa-upload"></i>Vyber obrázok    
                                <input class="input_img" type="file" id="file-input" accept="image/*"  onchange="previewImage(this)" multiple="false" name="profile-photos" value="">           
                            </label>
                            <script src="../scripts/show_image.js"></script>
                            <img class="profile_change_img" id="preview" src="" alt="" >
                            <input type="hidden" name="user" value="<?php echo $_SESSION["account"]["name"]; ?>">                                                  
                            <button class="submit one" name="add-avatar">Zmeniť profilovú fotku</button>
                        </form>                                  

                        
                    </div> 
                </div>

    </div>
</body>
<?php
include('../parts/footer.php');
?>
</html>