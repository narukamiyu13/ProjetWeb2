<?php

$profilUserActuel=$_SESSION['userID'];
 if(isset($_POST['modifier'])){
    $tonUsager->modifierProfilUser($profilUserActuel);
    $tonUsager = $this->modele->profilUtilisateur($_GET['userID']);
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
                <ul class="flex-outer">
                     <li>
                         <h1>Modifier le profil</h1>
                    </li>
                    <li>
                         <img class="rond" src="<?php if($tonUsager->urlPhoto!=NULL){echo"$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="150px" height="150px" alt="photoProfil">
                        <h3><?php echo $tonUsager->nomUtilisateur;?></h3>
                    </li>
                      <li>
                        <label for="nomUtilisateur">Nom d'utilisateur</label>
                        <input type="text" id="nomUtilisateur" name="nomUtilisateur" value="<?php echo $tonUsager->nomUtilisateur;?>">
                         
                    </li>
                    <li>
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $tonUsager->prenom;?>">
                    </li>
                    <li>
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?php echo $tonUsager->nom;?>">
                    </li>
                    <li>
                        <label for="courriel">Courriel</label>
                        <input type="email" id="courriel" name="courriel" value="<?php echo $tonUsager->courriel;?>">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="6" id="description" name="description"><?php echo $tonUsager->description;?></textarea>
                    </li>
                    <li>
                        <p>Sexe</p>
                        <ul class="flex-inner">
                            <li>
                                <input type="radio" id="F" name="sexe" value="F"<?php if($tonUsager->sexe=="F") {echo "checked";}?>>
                                <label for="F">F</label>
                            </li>
                            <li>
                                <input type="radio" id="H" name="sexe" value="H"<?php if($tonUsager->sexe=="H") {echo "checked";}?>>
                                <label for="H">H</label>
                            </li>
                        </ul>
                    </li>
                    <li>
                      
                        <input type="file" name="image">
                 
                        
                        <?php
                            //$folder = '/app/assets/images/';
                           // $image= $folder . basename($_FILES['image']['name']);

                            //echo '<pre>';
                            //if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                            //    echo "File is valid, and was successfully uploaded.\n";
                            //} else {
                           //    echo "Possible file upload attack!\n";
                           // }

                        ?>
                    </li>
                    <li>
                        <button type="submit" name="modifier">Modifier</button>
                    </li>
                </ul>
            </form>
        </div>
    </body>
</html>
