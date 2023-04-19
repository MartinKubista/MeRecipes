<!DOCTYPE html>
<head>
<title>MyRecipes</title>
    <meta charset="utf-8"  />
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/fonts.css">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../css/login.css">   

</head>
<html>
<?php
require_once('../scripts/connection.php');
include('../parts/hlava.php');
?>

<body>
<?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
    <div class="main-div-register">
   <div class="form-container">
        <div class="padding-setting">
            <div class="form login">
                <span class="title">Registrácia</span>
                <form action="../scripts/register_script.php" method="post">
                    <div class="input-fields">
                        <input type="text" placeholder="Zadaj svoje meno" id="name" name="name" require>
                        <span class="material-symbols-outlined" class="icon">person</span>  
                    </div>
                    <div class="input-fields">
                        <input type="email" placeholder="Zadaj svoj email" id="email" name="email" require>
                        <span class="material-symbols-outlined" class="icon">mail</span>  
                    </div>
                    <div class="input-fields">
                        <input type="password" class="password" placeholder="Zadaj svoje heslo" id="password" name="password" required>
                        <span class="material-symbols-outlined" class="icon" onkeyup="checkPassword(this.value)">lock</span>
                    </div>
                    <div class="input-fields">
                        <input type="password" class="password" placeholder="Zadaj znova heslo" id="password-r" name="password-r" required>
                        <span class="material-symbols-outlined" class="icon">lock</span>
                    </div>
                    <p class="message"><?php echo $message ?></p>
                    <div class="input-fields button">
                        <input style="color: white;" type="submit" value="Registrovať">
                    </div>
                </form>
                <div class="not-a-member">
                    <span class="text">Už máte účet?
                        <a href="login.php" class="signup-text">Prihláste sa</a>
                    </span>
                </div>
            </div>
        </div>
   </div>
   </div>



</body>
<?php
include('../parts/footer.php');
?>
</html>