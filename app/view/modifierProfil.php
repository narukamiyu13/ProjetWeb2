

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
            <form>
                <ul class="flex-outer">
                     <li>
                         <h2>bloup</h2>
                         <h1>Modifier le profil</h1>
                    </li>
                    <li>
                         <img class="rond" src="<?php if($tonUsager->urlPhoto!=NULL){echo"$tonUsager->urlPhoto";}else{echo"app/assets/images/images.png";}?>" width="150px" height="150px" alt="photoProfil">
                        <h3><?php echo $tonUsager->nomUtilisateur;?></h3>
                    </li>
                      <li>
                        <label for="nomUtilisateur">Nom d'utilisateur</label>
                        <input type="text" name="nomUtilisateur" id="username" value="<?php echo $tonUsager->nomUtilisateur;?>">
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
                        <input type="email" name="courriel" id="courriel" value="<?php echo $tonUsager->courriel;?>">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="6" name="description" id="description"><?php echo $tonUsager->description;?></textarea>
                    </li>
                    <li>
                        <p>Sexe</p>
                        <ul class="flex-inner">
                            <li>
                                <input name="sexe" type="checkbox" id="F" <?php if($tonUsager->sexe=="F"){ echo "checked"} ?>  >
                                <label for="F">F</label>
                            </li>
                            <li>
                                <input name="sexe" type="checkbox" id="H" <?php if($tonUsager->sexe=="H"){ echo "checked"} ?>>
                                <label for="H">H</label>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button type="submit">Submit</button>
                    </li>
                </ul>
            </form>
        </div>
    </body>
</html>
