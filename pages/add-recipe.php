<!DOCTYPE html>
<html lnag="en">
<head>
    <link href="../css/add-recipe.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/fonts.css">  
    <link rel="shortcut icon" href="#">
    <title>Pridaj recept</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="https://kit.fontawesome.com/cfb876ecbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php
   require_once('../scripts/connection.php');
   require_once ('../scripts/add_recipe.php');
   include('../parts/hlava.php');
?>
<?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
    <div class="margin">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="title-1">
                <h2>Úvod</h2>
            </div>
            <div class="label-input-group">
                <label class="label-uvod" for="nazov-receptu">Názov receptu:</label>
                <p>
                <input class="input-uvod" type="text" name="nazov-receptu" id="nazov-receptu" placeholder="Sem napíšte názov receptu">
            </div>
            <div class="label-input-group">
                <label class="label-uvod" for="popis-receptu">Popis receptu:</label>
                <p>
                <textarea class="textarea-uvod" name="popis-receptu" id="popis-receptu" placeholder="Sem napíšte stručný popis receptu"></textarea>
            </div>
            <br>
            
            <br>
            <hr>
            <br>
            <div class="title">
               <h2>Suroviny</h2>
            </div>
            <div class="label-input-group">
                <p>
                <textarea class="textarea-uvod" name="suroviny" id="suroviny" placeholder="Sem zadajte suroviny a k nim množstvo"></textarea>
                <small class="small">Suroviny zadávajte v tvare jednotka množstvo surovina a oddeľujte čiarkou(1 kus maslo, 0.5 kg múky)</small>
            </div>
            <br>
            <br>
            <br>
            <hr>
            <br>
                <div class="title">
                    <h2>Postup receptu</h2>
                </div>
                <div class="label-input-group">
                <label class="label-uvod" for="">Pridáva sa po vytvorení receptu </label>
                </div>
                <br>
   
            <br>
            <br>
            
            <hr>
            <br>
            <div class="title">
                <h2>Kategória receptu</h2>
            </div>
            <div class="label-input-group">
                <div class="typ-jedla"></div>
                    <lable class="kategoria-subtitle">Typ jedla</label>
                           <select name="options" id="options">
                              <option value="">Vyber typ jedla</option>
                              <option value="Polievky">Polievky</option>
                              <option value="Cestoviny">Cestoviny</option>
                              <option value="Jedlá z húb">Jedlá z húb</option>
                              <option value="Mäsité jedlá">Mäsité jedlá</option>
                              <option value="Bezmäsité jedlá">Bezmäsité jedlá</option>
                              <option value="Jedlá z rýb">Jedlá z rýb</option>
                              <option value="Koláče a dezerty">Koláče a dezerty</option>
                              <option value="Torty">Torty</option>
                              <option value="Salaty">Šaláty</option>
                              <option value="Exotické jedlá">Exotické jedlá</option>
                              <option value="Nátierky">Nátierky</option>
                              <option value="Nápoje">Nápoje</option>
                           </select>
                            <br>
                </div>
                <br>
                <br>
                <br>

                <hr>
                <br>

                <div class="title">
                    <h2>Hlavná fotografia k receptu</h2>       
                </div>
                <br>

                <div class="profile-pic-div">
                        <label for="file-input" class="file-input1">
                           <i class="fa-solid fa-upload"></i>Vyber obrázok    
                           <input type="file" id="file-input" accept="image/*" onchange="previewImage(this)" multiple="false" name="recipes-images" value="">           
                        </label>
                        <script src="../scripts/show_image.js"></script>
               </div>
               <img id="preview" src="" alt="" >
               <br>
                <br>
                <br>

                <hr>
                <br>
               <div class="title">
                    <h2>Video k receptu</h2>       
                </div>
                <div class="label-input-group">
                    <label class="label-uvod" for="nazov-receptu">Tu zadajte YouTube link:</label>
                    <p>
                    <input class="input-uvod" type="text" name="link" id="link" placeholder="Sem zadajte YouTube link">
                </div>  
               <br>
               <br>
               <hr>
               <br>
               <div class="title">
                     <h2>Podrobnosti k receptu</h2>
               </div>
               <div class="label-input-group">
                  <label class="label-uvod" for="priprava-v-minutach">Príprava v minútach:</label>
                  <p>
                  <input class="input-uvod_podrobnosti" type="text" name="priprava-v-minutach" id="priprava-v-minutach">
                  <br>
                  <small class="small">Zadaj čas celkovej prípravy v minútach (iba číslo)</small>
               </div>
               <div class="label-input-group">
                  <label class="label-uvod" for="varenie-pecenie">Varenie alebo pečenie v minútach:</label>
                  <p>
                  <input class="input-uvod_podrobnosti" type="text" name="varenie-pecenie" id="varenie-pecenie">
                  <br>
                  <small class="small">Zadaj čas tepelnej prípravy v minútach (iba číslo)</small>
               </div>
               <div class="label-input-group">
                  <label class="label-uvod" for="teplota">Teplota v °C:</label>
                  <p>
                  <input class="input-uvod_podrobnosti" type="text" name="teplota" id="teplota">
                  <br>
                  <small class="small">Zadaj teplotu v °C (iba číslo). Teplotu zadávaj len v prípade, ak sa jedlo pečie.</small>
               </div>
               <div class="label-input-group">
                  <label class="label-uvod" for="pocet-porci">Počet porcií:</label>
                  <p>
                  <input class="input-uvod_podrobnosti" type="text" name="pocet-porci" id="pocet-porci">
                  <br>
                  <small class="small">Zadaj počet porcií tohto jedla (pri použití gramáže, ktorú uvádzate v tomto recepte)</small>
               </div>
               <br>
               <hr>
            </div>
            <br>
            <p class="message"><?php echo $message ?></p>
            <div class="input-fields">
            <input type="submit" value="Vytvor recept" name="vytvor_recept">
        </div>
        </form>

    </div>
</body>
<?php
include('../parts/footer.php');
?>

