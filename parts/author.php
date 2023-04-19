<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil používateľa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/cfb876ecbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css"> 
    <link rel="stylesheet" href="../css/fonts.css"> 
</head>
<body>
    <?php
        require_once('../scripts/connection.php');
        require_once('../scripts/users.php');
        include('../parts/hlava.php');
    ?>

    <?php 
        if (isset($_GET['user'])) {
            $user = $_GET['user'];
            if(isset($_SESSION["account"]) && $_SESSION["account"]["user_type"] == 'admin'){
                $results = mysqli_query($conn, "SELECT * FROM recepty WHERE username = '$user' ORDER BY date_of_create DESC");
            }
            else{
                $results = mysqli_query($conn, "SELECT * FROM recepty WHERE new_old = 'old' && username = '$user' ORDER BY date_of_create DESC");
            }  
            $results2 = mysqli_query($conn, "SELECT * FROM users WHERE name = '$user'");                           
        }

        
    ?>

    <h1 class="title">Recepty užívateľa <?= $user ?>
        <?php while ($row = mysqli_fetch_assoc($results2)) { ?>
            <?php if ($row['avatar']): ?>
                <img src="../profile-photos/<?= $row['avatar'] ?>" alt="" class="author">
            <?php endif; ?>
        <?php } ?> 
    </h1>

    <div class="grid-container content">                              
        <?php while ($row = mysqli_fetch_assoc($results)) { ?>
            <div class="grid-item">
                <?php if ($row['image_data']): ?>
                    <img class=" img-thumbnail main-img" src="../recipes-images/<?= $row['image_data'] ?> ">
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
                        if (strlen($string) > 250) {
                        
                            // skráť reťazec
                            $stringCut = substr($string, 0, 250);
                            $endPoint = strrpos($stringCut, ' ');
                        
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                        }
                        echo $string;
                    ?>
                </div>
                <?php $string = strip_tags($row["popis_receptu"]); 
                        if (strlen($string) > 250): ?>
                    
                <?php endif; ?>
                <div class="time">
                    <i class="far fa-calendar-alt"></i>
                    <?php
                        $time = "SELECT date_of_create FROM recepty";
                        $cr_date=date_create($row['date_of_create']);
                        $for_date=date_format($cr_date,'d.m.Y H:i');                                
                        echo $for_date; 
                    ?>                                    
                </div>
            </div>                                                 
        <?php } ?>                
    </div>

</body>
<?php
include('../parts/footer.php');
?>
</html>