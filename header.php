 <script src="app/assets/js/menu.js"></script>


<?php// include_once("app/controller/controller.php");  ?>

<header class="hed">

	<!--    menu slider-->
	<?php

   if(!isset($_SESSION['userID']))
       {
           
       ?>

    <div id="menuSlider" class="sideMenu">
        <a href="javascript:void(0)" class="fermer" >&times;</a>
        <a href="inscription.php">Profil</a>
        <a href="inscription.php">Découverte</a>
        <a href="inscription.php">Recherche</a>
        <a href="inscription.php">Modifier le profil</a>
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
    </div>

    <?php    
              }else {
       ?>    
        <div id="menuSlider" class="sideMenu">
            <a href="javascript:void(0)" class="fermer" >&times;</a>
            <a href="profil.php?userID=<?= $_SESSION['userID']?>">Profil</a>
            <a href="#">Découverte</a>
            <a href="#">Recherche</a>
            <a href="profil.php?userID=<?= $_SESSION['userID']?>&modifier">Modifier le profil</a>
            <a href="index.php?deconnexion">Déconnexion</a>
        </div>   
      <?php     
       }
    ?>
    
        <!--    entete-->
        <nav id ="navbar">
           <div class="row">  
                
                <div id="menucentre">
                    <h2><a href="index.php">Foodie</a></h2>
                </div>    
                <ul>
                    <img id="menu" src="app/assets/images/menu.png" alt="menu"/>
                    <li class="droiteMenu"><a href="">Découverte </a></li>
                    <li class="droiteMenu"><?php echo !isset($_SESSION['userID'])? '<a href="connexion.php">Connexion</a>' : '<a href="index.php?deconnexion">Déconnexion</a>' ?></li>	 
                </ul>
            </div>  
        </nav>
</header>

 


