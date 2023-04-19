<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css"> 
    <title>Recept</title>
</head>
<body>
    <?php
        require_once('../scripts/connection.php');
        require_once('../scripts/users.php');
        include('../parts/hlava.php');
        require_once ('../scripts/add-review.php');
    ?>

    <?php 
        if (isset($_GET['recipe'])) {
            $id = $_GET['recipe'];
            $record = mysqli_query($conn, "SELECT * FROM recepty WHERE recept_id=$id");
            $n = mysqli_fetch_array($record);
            $video_id = $n["link"];
            $embed_code = '<div class="video-container" style="text-align:center;"><iframe width="700" height="400" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
            $nazov = $n['nazov_receptu'];
            $content = $n['popis_receptu'];
            $suroviny = $n['suroviny'];
            $options = $n['options'];
            $priprava = $n['priprava_v_minutach'];
            $varenie = $n['varenie_pecenie'];
            $teplota = $n['teplota'];
            $porcie = $n['pocet_porci'];
            $img = $n['image_data'];
            $user = $n['username'];
            $datetime = $n['date_of_create'];
            $new_old = $n['new_old'];

            $record2 = mysqli_query($conn, "SELECT * FROM images WHERE recept_id=$id");


            $record3 = mysqli_query($conn, "SELECT * FROM reviews WHERE recept_id = $id");

            $record4 = mysqli_query($conn, "SELECT * FROM users WHERE name = '$user'");            
        }
    ?>

    <div class="content">
        <div class="recipe-content">
            
            <?php if ($new_old == 'new' && isset($_SESSION["account"]) && $_SESSION["account"]["user_type"] == 'admin'): ?>
                <p class="m-2">Nový recept!</p> 
                <a href="../scripts/confirm-delete.php?confirm=<?php echo $id; ?>">
                    <button class="btn-success new-recept" name="confirm" href="/admin_page.php">Schváliť</button>
                </a> 
                <a href="../scripts/confirm-delete.php?delete=<?php echo $id; ?>">
                    <button class="btn-danger new-recept" name="delete" href="/admin_page.php">Neschváliť</button>  
                </a>                         
            <?php endif; ?>
            <h1><?= $nazov ?></h1>
            <div class="/*mt-4*/" style="margin-left: 1.5%;">
                <i class="far fa-calendar-alt"></i> Pridané: 
                <?php
                    $time = "SELECT date_of_create FROM recepty";
                    $cr_date=date_create($datetime);
                    $for_date=date_format($cr_date,'d.m.Y');                                
                    echo $for_date; 
                ?>
                <?php while ($row3 = mysqli_fetch_assoc($record4)) { ?>
                <p> Autor: 
                <a class="hover-color" href="../parts/author.php?user=<?= $user ?>">
                    <?php if (!empty($row3["avatar"])): ?>
                    <img src="../profile-photos/<?= $row3["avatar"] ?>" alt="" class="photo">
                    <?php endif; ?>
                    <?= $user ?>
                </a> 
                </p>
            <?php } ?>    
                                               
            </div>  
            <?php if($img): ?>
                <img src="../recipes-images/<?= $img ?>" class="main-img">
            <?php endif; ?>                                  
            
            <div class="popis">
                <p><?= $content ?></p>
            </div>
            <hr>
            <?php if($priprava || $varenie || $teplota || $porcie): ?>
                <div class="grid d-flex justify-content-center">
                <?php  if($porcie && !empty($porcie)):  ?>
                    <i class="d-flex align-items-center ">
                    <span class="material-symbols-outlined mr-2" style="font-size: 45px; padding-right: 3%">restaurant</span>
                    <div class="d-flex flex-column" style="width: 80px;" >
                        <span><?= $porcie ?></span>
                        <span>porcie</span>
                    </div>
                    </i>
                <?php endif; ?>
                <?php if($priprava && !empty($priprava)): ?>
                    <i class="d-flex align-items-center ">
                    <span class="material-symbols-outlined mr-2" style="font-size: 45px;padding-right: 3%">schedule</span>
                    <div class="d-flex flex-column" style="width: 80px;" >
                        <span><?= $priprava ?> minút</span>
                        <span>príprava</span>
                    </div>
                    </i>        
                <?php endif; ?>  
                <?php if($varenie && !empty($varenie)): ?>
                    <i class="d-flex align-items-center ">
                    <span class="material-symbols-outlined mr-2" style="font-size: 45px;padding-right: 3%">local_fire_department</span>
                    <div class="d-flex flex-column" style="width: 80px;">
                    <span><?= $varenie ?> minút</span>
                    <?php if($teplota && !empty($teplota)): ?>
                        <span class="">na <span><?= $teplota ?>°C</span></span>
                    <?php else: ?>
                        <span class="">tepelná úprava</span>
                    <?php endif; ?>
                    </div>
                    </i>
                <?php endif; ?>    
                </div>
            <?php endif; ?>
            <hr>
            <br>
            <br>
            <ol>
                <?php while ($row = mysqli_fetch_assoc($record2)) { ?>              
                    <li>            
                        
                        <?= $row["postup"] ?>
                        <br>
                        <img src="../recipes-images/postup-images/<?= $row["array_image"] ?>" alt="" class="main-img">                       
                    </li>
                <?php } ?>
            </ol>
            <br>

            <?php  if($video_id && !empty($video_id)):  ?>
                <h1>Video</h1>
                    <?php echo $embed_code; ?>
            <?php endif; ?>

            
            <h1>Suroviny</h1>
            <p class="suroviny"><?= $suroviny ?></p>

            <?php while ($row3 = mysqli_fetch_assoc($record4)) { ?>
                <p> Autor: 
                <a class="hover-color" href="../parts/author.php?user=<?= $user ?>">
                    <?php if (!empty($row3["avatar"])): ?>
                    <img src="../profile-photos/<?= $row3["avatar"] ?>" alt="" class="photo">
                    <?php endif; ?>
                    <?= $user ?>
                </a> 
                </p>
            <?php } ?>
            <br>
            <div>
                <h1>Komentáre</h1>
                <?php while ($row2 = mysqli_fetch_assoc($record3)) { ?>
                <?php 
                    $review_author = $row2["username"];
                    $record5 = mysqli_query($conn, "SELECT * FROM users WHERE name = '$review_author'");
                    while ($row4 = mysqli_fetch_assoc($record5)) {
                ?>
                <div class="review"> 
                    <a style="margin-left: 10px; display: inline-block;" href="../parts/author.php?user=<?= $row2["username"] ?>" class="review-author">     
                    <?php if (!empty($row4["avatar"])): ?>
                        <img src="../profile-photos/<?= $row4["avatar"] ?>" alt="" class="photo">                 
                    <?php endif; ?>
                    <span class="m-1 hover-color"><?= $row2["username"] ?></span>                       
                    </a>
                    <?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == 'admin' || $_SESSION["account"]["name"] == $row2["username"] || $_SESSION["account"]["user_type"] == "moderator")): ?>
                        <a style="display: inline-block; float: right" href="../scripts/delete-comment.php?edit=<?php echo $id; ?>&zmaz=<?php echo $row2["id"]; ?>">
                            <span class="material-symbols-outlined btn-danger1" style="color: red;  ">close</span>
                        </a>
                    <?php endif; ?>
                    <p><i class="far fa-calendar-alt" aria-hidden="true"></i>
                    <?php
                        $time = "SELECT datetime FROM reviews";
                        $cr_date=date_create($row2['datetime']);
                        $for_date=date_format($cr_date,'d.m.Y');                                
                        echo $for_date; 
                    ?>
                    </p>
                    <p><?= $row2["review"] ?></p>
                </div>
                <?php }} ?>

                <?php  if (isset($_SESSION["account"])): ?>
                    <form action="" class="form-review" method="post">
                        <textarea name="review" id="" rows="4" placeholder="Napíš komentár"></textarea>
                        <input type="hidden" name="username" value="<?php echo $_SESSION["account"]["name"]; ?>">
                        <input type="hidden" name="recept_id" value="<?php echo $id; ?>">
                        <button class="submit" name="add-review">Pridať komentár</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<?php
include('../parts/footer.php');
?>
</html>