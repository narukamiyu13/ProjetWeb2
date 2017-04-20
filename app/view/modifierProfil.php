<?php

$profilUserActuel=$_SESSION['userID'];
//upload

if(isset($_POST['enregistrer'])) {

    $tonUsager->modifierPhotoProfil($profilUserActuel);
    $tonUsager = $this->modele->profilUtilisateur($_GET['userID']);

    $target_dir = "app/photoProfil/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["enregistrert"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
           // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
           // echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
       // echo "Sorry, file already exists.";
$target_file = $target_dir ."copy(1)-".basename($_FILES["photo"]["name"]);

    }
    // Check file size
    if ($_FILES["photo"]["size"] > 5000000) {
       // echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
       // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
           // echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
        } else {
          //  echo "Sorry, there was an error uploading your file.";
        }
    }

}


 if(isset($_POST['modifier'])){
    $tonUsager->modifierProfilUser($profilUserActuel);
    $tonUsager = $this->modele->profilUtilisateur($_GET['userID']);
    header("location:profil.php?userID=".$_GET['userID']);
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--
        %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        NOM : 
        PROJET : Foodie
        ORGANISDATION : College Maisonneuve
        PAGE : modifierProfil.php
        DATE DE CREATION : 27-03-17
        DESCRIPTION : page d'accueil

        %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        -->
        <meta charset="utf-8">
        <title>Home</title>
        <link href="app/assets/reset.css" rel="stylesheet">
        <link href="app/assets/style.css" rel="stylesheet">
        <link href="app/assets/style-laurie.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

         <!-- police de google -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

          <!-- menu JavaScript -->
        <script src="app/assets/js/menu.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body id="page-top">

        <?php include_once'header.php'; ?>
        <header class='backgroundInscription' id="heroSign"  >
        <div class="flexHead center" id="wrapperModifierProfil">
            <form action="profil.php&#63;userID=<?php echo $profilUserActuel?>&modifier=" method="post">
                <div class="wrapperIn" >
        
                <div>
                    <label>

                        <h3 id="utilisateur"><?php echo $tonUsager->nomUtilisateur;?></h3>
                        <img class="rond" id="imagerond" src="<?php if($tonUsager->urlPhoto!=NULL){echo"$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="150px" height="150px" alt="photoProfil">

                        <button type="submit" class="btnModifier" name="modifier">Modifier Profil</button>
                     </label> 
                    
                    <label>
                        <input type="text" id="nomUtilisateur" name="nomUtilisateur" value="<?php echo $tonUsager->nomUtilisateur;?>">
                        <span>Nom de l'utilisateur</span>
                        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                    </label>

                    <label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $tonUsager->prenom;?>">
                        <span>Prenom</span>
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </label>
                    <label>
                        <input type="text" id="nom" name="nom" value="<?php echo $tonUsager->nom;?>">
                           <span>Nom</span>
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </label>
                    <label>
                        <input type="email" id="courriel" name="courriel" value="<?php echo $tonUsager->courriel;?>">
                           <span>Courriel</span>
                       <i class="fa fa-envelope" aria-hidden="true"></i>
                    </label>

                    <label>
                        <input  id="description" type="text" name="description" value="<?php echo $tonUsager->description;?>">
                        <span>Description</span>
                      <i class="fa fa-comment-o" aria-hidden="true"></i>
                    </label>
                    <label>
                        <span id="sexeF">F</span>
                        <input type="radio" id="F" name="sexe" value="F"<?php if($tonUsager->sexe=="F") {echo "checked";}?>>
                        <span id="sexeH">H</span>
                        <input type="radio" id="H" name="sexe" value="H"<?php if($tonUsager->sexe=="H") {echo "checked";}?>>
                    </label>   
                       

                    </form>
                    </div>
                    <div id="ModfierPhoto">
                        <form action="profil.php&#63;userID=<?php echo $profilUserActuel?>&modifier=" method="post" enctype="multipart/form-data">

                            
   
                            
                        <p> Selectionner une image</p>
                            <label class="btnImage" for="fileToUpload"> Selectionner Image</label>
                            <input   type="file" name="photo" id="fileToUpload" >
                            <input type="submit" value="Enregistrer image" name="enregistrer" id="enregistrerImage" >
                        </form>
                      </div>  
                </div>
            </div> 
    </header>        


    </body>
</html>
