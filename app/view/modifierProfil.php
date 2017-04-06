<?php

$profilUserActuel=$_SESSION['userID'];
//upload

if(isset($_POST['enregistrer'])) {

    $tonUsager->modifierPhotoProfil($profilUserActuel);
    $tonUsager = $this->modele->profilUtilisateur($_GET['userID']);

    $target_dir = "app/photoProfil/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
        $uploadOk = 0;
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
         <!-- police de google -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

          <!-- menu JavaScript -->
        <script src="app/assets/js/menu.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body class="modifier">
        <div class="container">
            <form action="profil.php&#63;userID=<?php echo $profilUserActuel?>&modifier=" method="post">
                <img class="rond" src="<?php if($tonUsager->urlPhoto!=NULL){echo"$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="150px" height="150px" alt="photoProfil">
                <h3><?php echo $tonUsager->nomUtilisateur;?></h3>
                <label for="nomUtilisateur">Nom d'utilisateur</label>
                <input type="text" id="nomUtilisateur" name="nomUtilisateur" value="<?php echo $tonUsager->nomUtilisateur;?>">
                <label for="prenom">Prenom</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $tonUsager->prenom;?>">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo $tonUsager->nom;?>">
                <label for="courriel">Courriel</label>
                <input type="email" id="courriel" name="courriel" value="<?php echo $tonUsager->courriel;?>">
                <label for="description">Description</label>
                <textarea rows="6" id="description" name="description"><?php echo $tonUsager->description;?></textarea><p>Sexe</p>
                <label for="F">F</label>
                <input type="radio" id="F" name="sexe" value="F"<?php if($tonUsager->sexe=="F") {echo "checked";}?>>
                <label for="H">H</label>
                <input type="radio" id="H" name="sexe" value="H"<?php if($tonUsager->sexe=="H") {echo "checked";}?>><button type="submit" name="modifier">Modifier</button>
            
            </form>
            <form action="profil.php&#63;userID=<?php echo $profilUserActuel?>&modifier=" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="photo" id="fileToUpload">
                <input type="submit" value="Upload Image" name="enregistrer">
            </form>
            
        </div>
    </body>
</html>
