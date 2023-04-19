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
        <?php $result = mysqli_query($conn, "SELECT * FROM users WHERE name = '$user'"); ?>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <?php if ($result): ?>
                <div class="container_profile">
                    <?php if ($row['avatar']): ?>
                        <div class="img_container">
                            <img src="../profile-photos/<?= $row['avatar'] ?>" alt="" class="avatar">
                            <h1><?= $row['name']?></h1>
                            <div class="container_2a">
                                <a href="../pages/page-change-password.php?user=<?php echo $_SESSION["account"]["name"]; ?>">
                                    <button class="button_heslo">Zmeň heslo</button>
                                </a>
                                <a href="../pages/page-add-avatar.php?user=<?php echo $_SESSION["account"]["name"]; ?>">
                                    <button class="button_img">Zmeň profilovú fotku</button>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            <?php endif; ?>
        <?php } ?> 

        <?php $results = mysqli_query($conn, "SELECT * FROM recepty WHERE username = '$user' ORDER BY date_of_create DESC"); ?>
        <h1 class="title">Moje recepty</h1>
        <div class="grid-container">                              
            <?php while ($row = mysqli_fetch_assoc($results)) { ?>
                <div class="grid-item">
                    <?php if ($row['image_data']): ?>
                        <img class="img-thumbnail main-img" src="../recipes-images/<?= $row['image_data'] ?> ">
                    <?php endif; ?>
                    <h2 class="m-2 "> 
                        <a href="../pages/recipe.php?recipe=<?php echo $row['recept_id']; ?>">
                            <?php 
                            $recipeTitle = $row["nazov_receptu"]; 
                            if (strlen($recipeTitle) > 42) {
                                echo substr($recipeTitle, 0, 39) . "...";
                            } else {
                                echo $recipeTitle;
                            }
                            ?>
                        </a> 
                    </h2>
                        
                    <div class="article-content"> 
                        <?php
                            $string = strip_tags($row["popis_receptu"]);
                            if (strlen($string) > 200) {
                            
                                // skráť reťazec
                                $stringCut = substr($string, 0, 200);
                                $endPoint = strrpos($stringCut, ' ');
                            
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '...';
                            }
                            echo $string;
                        ?>
                    </div>
                    <?php $string = strip_tags($row["popis_receptu"]); 
                            if (strlen($string) > 200): ?>
                        
                    <?php endif; ?>
                    <div class="time">
                        <i class="far fa-calendar-alt"></i>
                        <?php
                            $time = "SELECT date_of_create FROM recepty";
                            $cr_date=date_create($row['date_of_create']);
                            //$for_date=date_format($cr_date,'d.m.Y H:i');  
                            $for_date=date_format($cr_date,'d.m.Y');                               
                            echo $for_date; 
                        ?>                                     
                    </div>
                </div>                                                 
            <?php } ?>                
        </div>
    </div>
</body>
<?php
include('../parts/footer.php');
?>
</html>