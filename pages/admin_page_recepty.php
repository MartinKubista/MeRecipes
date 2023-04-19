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
    <!-- datatables.net -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</head>
    <?php
        require_once('../scripts/connection.php');
        require_once('../scripts/users.php');
        include('../parts/hlava.php');
    ?>
    <?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == 'admin' || $_SESSION["account"]["user_type"] == "moderator")): ?>
<body>
    <?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == "moderator")): ?><body>
        <nav class="topnav height_of_nav"  id="myTopnav">
                <a href="admin_page.php">Nepotvrdené recepty</a>
                <a style="background-color: #ddd; color: black;" href="admin_page_recepty.php">Recepty</a>
                <a href="admin_page_pouzivatelia.php">Použivatelia</a>
                <a href="admin_page_komentare.php">Komentáre</a>
        </nav>    
    <?php endif; ?>

    <?php if (isset($_SESSION["account"]) && ($_SESSION["account"]["user_type"] == "admin")): ?><body>
        <nav class="topnav height_of_nav"  id="myTopnav">
                <a href="admin_page.php">Nepotvrdené recepty</a>
                <a style="background-color: #ddd; color: black;" href="admin_page_recepty.php">Recepty</a>
                <a href="admin_page_komentare.php">Komentáre</a>
        </nav>    
    <?php endif; ?>

    <?php

        $results_query = mysqli_query($conn, "SELECT * FROM recepty ORDER BY date_of_create");
    

    ?>   
    <div style="height: 600px; overflow-y: auto; padding: 2%">
        <table id="" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Názov receptu</th>
                    <th>Typ receptu</th>
                    <th>Vytvoril</th>
                    <th>Dátum vytvorenia</th>
                    <th>Zmaž</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results_query)) { ?>
                    <tr>
                        <td><?php echo($row['recept_id']) ?></td>
                        <?php echo '<td><a href="recipe.php?recipe=' . $row['recept_id'] . '">' . $row['nazov_receptu'] . '</a></td>'; ?>
                        <td><?php echo($row['options']) ?></td>
                        <?php echo '<td><a href="../parts/profile.php?user=' . $row['username'] . '">' . $row['username'] . '</a></td>'; ?>
                        <td><?php echo($row['date_of_create']) ?></td>
                        <td width="110"><a href="../scripts/delete_recipe.php?delete=<?php echo$row['recept_id']; ?>" class="btn btn-danger mr-2">Zmazať</a></td>
                    </tr>
                <?php } ?> 
            </tbody>
        </table>         
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable();
    });
    </script>
</body>

<?php
include('../parts/footer.php');
?>
</html>
<?php endif; ?>
