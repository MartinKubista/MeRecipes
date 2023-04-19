<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css"> 
    <link rel="stylesheet" href="../css/change-password.css"> 
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
                <?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
                <div class="login-body">
                    <div class="form-container">
                        <div class="padding-setting">
                            <div class="form login">      
                                <span class="title">Zmena hesla</span>  
                                <form action="" method="post">
                                        <div class="input-fields">
                                            <input type="password" class="password" placeholder="Zadaj staré heslo" id="old" name="old" required>
                                            <span class="material-symbols-outlined" class="icon">lock</span>
                                        </div>

                                        <div class="input-fields">
                                            <input type="password" class="password" placeholder="Zadaj nové heslo" id="new" name="new" required>
                                            <span class="material-symbols-outlined" class="icon">lock</span>
                                        </div>
                                        <p class="message"><?php echo $message ?></p>
                                    <input type="hidden" name="user" value="<?php echo $_SESSION["account"]["name"]; ?>">                                                  
                                    
                                    <div class="input-fields button">
                                        <input style="color: white;" type="submit" value="Zmeniť heslo" name="change-password">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php } ?> 

    </div>
                     
</body>
<?php
include('../parts/footer.php');
?>
</html>