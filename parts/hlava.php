<!DOCTYPE html>
<html lnag="en">
<head>
    <link href="../css/header.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/fonts.css">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css"> 

</head>
<?php 

    require_once('../scripts/users.php');

    if(isset ($_SESSION["account"])){
        $user = $_SESSION["account"]["name"];
        $record = mysqli_query($conn, "SELECT * FROM users WHERE name = '$user'");
    }
    
?>

<header>
    <div class="main-div">
        <div class="logo-div">
            <a href="../pages/index.php"  ><img class="logo"src="../images/MyRecipes-logo1.jpg" alt="MyRecipes"></a>
        </div>
        <?php if (!isset($_SESSION["account"])) : ?>
        <button class="btn-info11">
            <div class="main-div-pad">
                <a href="../pages/login.php" class="main-a">
                    <span class="material-symbols-outlined md-48">person</span>
                    <span class="sign_in">Prihlásiť sa</span>
                </a>
            </div>
        </button>

        <?php else: ?>       
            <div class="right-hlava">
                <?php if ($_SESSION["account"]["user_type"] == 'admin' || $_SESSION["account"]["user_type"] == 'moderator'): ?>
                    <button class="btn-success1">
                        <a href="../pages/admin_page.php" class="main-a">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <span  class="button-add-recipe">Admin</span>
                        </a>   
                    </button>        
                <?php endif; ?>

                <button class="btn-success1">
                    <div class="main-div-pad">                    
                        <a href="../pages/add-recipe.php" class="main-a">
                            <span class="material-symbols-outlined">add</span>
                            <span  class="button-add-recipe">Pridaj recept</span>
                        </a>
                    </div>
                </button>

                <button class="btn-photo">
                    <div class="main-div-pad">
                            <a href="../parts/profile.php?user=<?php echo $_SESSION["account"]["name"]; ?>" class="main-a">
                                <?php while ($row = mysqli_fetch_assoc($record)) { 
                                    if($row["avatar"]):
                                ?>                                   
                                    <img src="../profile-photos/<?= $row["avatar"] ?>" alt="" class="photo">
                                <?php
                                    endif;
                                } ?>
                                <span class="sign_in"><?php echo $_SESSION["account"]["name"]; ?>                               
                            </a>
                    </div>
                </button>

                <button class="btn-info1" tabindex="1">
                    <div class="main-div-pad">
                    <a href="../scripts/logout.php" class="main-a"> 
                        <span class="material-symbols-outlined md-48">logout</span>                          
                        <span class="sign_in">Odhlásiť sa</span>
                    </a>
                    </div>
                </button> 
               

            </div>
            <label class="hamburger" for="toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </label>
            <script src="../scripts/header_hamburger.js"></script>

            
        <?php endif; ?>
    </div>
</header>
