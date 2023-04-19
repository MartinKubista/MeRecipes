<!DOCTYPE html>
<head>
<title>MyRecipes</title>
    <meta charset="utf-8"  />
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/fonts.css"> 
    <link rel="stylesheet" href="../css/main.css">   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<html>
</head>
<?php
    require_once('../scripts/connection.php');
    require_once('../scripts/users.php');
    include('../parts/hlava.php');
?>
<body>
<?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
   <div class="login-body">
   <div class="form-container">
        <div class="padding-setting">
            <div class="form login">
                <span class="title">Prihlásenie</span>
                <form action="" method="post">
                    <div class="input-fields">
                        <input type="text" placeholder="Zadaj svoje meno" id="name" name="name" require>
                        <span class="material-symbols-outlined" class="icon">mail</span>  
                    </div>
                    <div class="input-fields">
                        <input type="password" class="password" placeholder="Zadaj svoje heslo" id="password" name="password" required>
                        <span class="material-symbols-outlined" class="icon">lock</span>
                    </div>
                    <?php if($error["form"]): ?>
                    <section class="message">Vyplň správne prihlasovacie údaje</section>
                    <?php endif;?>
                    <div class="input-fields button">
                        <input style="color: white;" type="submit" value="Prihlásiť" name="login_user">
                    </div>
                </form>
                <div class="not-a-member">
                    <span class="text">Nemáte účet?
                        <a href="register.php" class="signup-text">Zaregistrujte sa</a>
                    </span>
                </div>
            </div>
        </div>
   </div>
   </div>
   <script src="../scripts/login_register.js"></script>

</body>
<?php
include('../parts/footer.php');
?>
</html>