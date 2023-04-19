<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyRecipes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/cfb876ecbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/fonts.css"> 
    <link rel="stylesheet" href="../css/main.css"> 
    <style>
        *{
            margin: 0;
            padding: 0;
            /*background-color: white;*/
        }
    </style>
</head>
    <?php
        require_once('../scripts/connection.php');
        require_once('../scripts/users.php');
        include('../parts/hlava.php');
        include('../parts/search-bar.php');
    ?>
<?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == 'admin' || $_SESSION["account"]["user_type"] == "moderator")): ?><body>

<?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == "moderator")): ?><body>
    <nav class="topnav"  id="myTopnav">
            <a style="background-color: #ddd; color: black;" href="admin_page.php">Nepotvrdené recepty</a>
            <a href="admin_page_recepty.php">Recepty</a>
            <a href="admin_page_pouzivatelia.php">Použivatelia</a>
            <a href="admin_page_komentare.php">Komentáre</a>
    </nav>   
<?php endif; ?>     

<?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == "admin")): ?><body>
    <nav class="topnav"  id="myTopnav">
            <a style="background-color: #ddd; color: black;" href="admin_page.php">Nepotvrdené recepty</a>
            <a href="admin_page_recepty.php">Recepty</a>
            <a href="admin_page_komentare.php">Komentáre</a>
    </nav>   
<?php endif; ?> 

<?php     
   
    // Get current page number, default is page 1
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Number of results per page
    $results_per_page = isset($_GET['results_per_page']) ? $_GET['results_per_page'] : 12;

    // Calculate the starting index for the results on the current page
    $start_index = ($page - 1) * $results_per_page;

    // Query to get the total number of results
    $count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM recepty WHERE new_old = 'new'");
    $count_result = mysqli_fetch_assoc($count_query);
    $total_results = $count_result['total'];

    // Calculate the total number of pages
    $total_pages = ceil($total_results / $results_per_page);
      
      if (isset($_GET['search'])) {
          $keyword = $_GET['keyword'];
          $search_words = explode(' ', $keyword);

          $where_clause = "WHERE ";
          $where_clause1 = "WHERE ";
          foreach ($search_words as $word) {
              $where_clause .= "CONCAT(nazov_receptu, popis_receptu, options, suroviny) LIKE '%$word%' AND ";
              $where_clause1 .= "CONCAT(postup) LIKE '%$word%' AND ";
          }
          $where_clause .= "1=1"; // Add a dummy condition to avoid syntax errors
          $where_clause1 .= "1=1"; 
          $results = mysqli_query($conn, "SELECT * FROM recepty $where_clause AND new_old = 'new'"); 
          $results1 = mysqli_query($conn, "SELECT * FROM images $where_clause1 "); 
          
      }

      else{
              $results = mysqli_query($conn, "SELECT * FROM recepty WHERE new_old = 'new' ORDER BY date_of_create DESC LIMIT $start_index, $results_per_page");
      }
?>
<h1 class="title">Recepty</h1>
    <form method="GET">
    <label style="margin-left: 5%; margin-bottom: 1%" for="results_per_page">Zobraz: </label>
    <select id="results_per_page" name="results_per_page" onchange="this.form.submit()">
        <option value="12" <?php if ($results_per_page == 12) echo 'selected'; ?>>12</option>
        <option value="24" <?php if ($results_per_page == 24) echo 'selected'; ?>>24</option>
        <option value="48" <?php if ($results_per_page == 48) echo 'selected'; ?>>48</option>
        <option value="60" <?php if ($results_per_page == 60) echo 'selected'; ?>>60</option>
    </select>
    <label  for="results_per_page">receptov</label>
    </form>
    <div class="grid-container">                              
        <?php while ($row = mysqli_fetch_assoc($results)) { ?>
            <div class="grid-item">
                <?php if ($row['new_old'] == 'new' && isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == 'admin' || $_SESSION["account"]["user_type"] == 'moderator')): ?>
                    <button class="btn-warning m-2" style="position: absolute;" ><a <?php echo $row["nazov_receptu"] ?> href="../pages/recipe.php?recipe=<?php echo $row['recept_id']; ?>"><p class="m-2">NOVÝ RECEPT!</p></a></button>             
                <?php endif; ?>
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
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center ">
            <li class="page-item <?php echo $page == 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?php echo $page == 1 ? '#' : '?page='.($page-1); ?>" aria-label="Previous">
                &laquo;
            </a>
            </li>
            <?php for ($i=1; $i<=$total_pages; $i++) { ?>
            <li class=" page-item <?php echo $page == $i ? 'active' : ''; ?>"><a class=" page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li class="page-item <?php echo $page == $total_pages ? 'disabled' : ''; ?>">
            <a class="page-link" href="<?php echo $page == $total_pages ? '#' : '?page='.($page+1); ?>" aria-label="Next">
            &raquo;
            </a>
            </li>
        </ul>
    </nav>
         
</body>


<?php
include('../parts/footer.php');
?>
</html>
<?php endif; ?>
