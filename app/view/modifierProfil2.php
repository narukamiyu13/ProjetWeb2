<?php
//echo $tonUsager->sexe;
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
    <link href="app/assets/style.css" rel="stylesheet">
    <link href="app/assets/reset.css" rel="stylesheet">
     <!-- police de google -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <!-- menu JavaScript -->
    <script src="app/assets/js/menu.js"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
    <div id="container">
        <div id="modfierProfil">
            <section class="formulaireProfil">
             <form action="profil.php&#63;userID=<?php echo $profilUserActuel?>&modifier=" method="post">
                    <div class="blockprofil">
                        <h1>Modifer votre profil</h1>
                        

                        
                        
                        
                        
                        
                         <form action="profil.php&#63;userID=<?php echo $profilUserActuel?>&modifier=" method="post">
                
                         <h1>Modifier le profil</h1>
                  
                         <img class="rond" src="<?php if($tonUsager->urlPhoto!=NULL){echo"$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="150px" height="150px" alt="photoProfil">
                        <h3><?php echo $tonUsager->nomUtilisateur;?></h3>
                    
                        <p for="nomUtilisateur">Nom d'utilisateur</p>
                        <input type="text" id="nomUtilisateur" name="nomUtilisateur" value="<?php echo $tonUsager->nomUtilisateur;?>">
                  
                        <p for="prenom">Prenom</p>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $tonUsager->prenom;?>">
                    
                        <p for="nom">Nom</p>
                        <input type="text" id="nom" name="nom" value="<?php echo $tonUsager->nom;?>">
                 
                        <p for="courriel">Courriel</p>
                        <input type="email" id="courriel" name="courriel" value="<?php echo $tonUsager->courriel;?>">
                 
                        <p for="description">Description</p>
                        <textarea rows="6" id="description" name="description"><?php echo $tonUsager->description;?></textarea>
                  
                        <p>Sexe</p>
                    
                         
                                <input type="radio" id="F" name="sexe" value="F"<?php if($tonUsager->sexe=="F") {echo "checked";}?>>
                                <p for="F">F</p>
                           
                                <input type="radio" id="H" name="sexe" value="H"<?php if($tonUsager->sexe=="H") {echo "checked";}?>>
                                <p for="H">H</p>
            
                      
                        <input type="file" name="image">
                 
                        
                       // <?php
                          //  $folder = '/app/assets/images/';
                          //  $image= $folder . basename($_FILES['image']['name']);

                         //   echo '<pre>';
                        //    if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
                       //         echo "File is valid, and was successfully uploaded.\n";
                        //    } else {
                       //         echo "Possible file upload attack!\n";
                        //   }

                        //?>
                 
                        <button type="submit" name="modifier">Modifier</button>
                
            </form>
                        </div>
                    </form>
            </section> 
        </div>
    </div>
</body>
</html>