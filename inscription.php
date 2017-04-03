<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="app/assets/style.css" rel="stylesheet">
    <!-- <link href="app/assets/bootstrap.min.css" rel="stylesheet"> -->
	<link href="app/assets/reset.css" rel="stylesheet">
     <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="app/assets/js/menu.js"></script>
</head>

<body>
 <?php // include_once("app/controller/controller.php");  ?> 

    
<body id="page-top">
	<div id="menuSlider" class="sideMenu">
          <a href="javascript:void(0)" class="fermer" >&times;</a>
          <a href="#">Profil</a>
          <a href="#">Découverte</a>
            <a href="#">Ajouter une photo</a>
          <a href="#">Recherche</a>
          <a href="#">Modifier le profil</a>
            <a href="#">Connexion</a>
            <a href="#">Déconnexion</a>
    </div>
    <div id="container">
        <!--    entete-->
        <nav id ="navbar">
            <div class="row">
                <ul>
                    <img id="menu" src="app/assets/images/menu.png" alt="menu"/>
                    <li><a href="">Découverte </a></li>
                     <li><a href="connexion.php">Connexion </a></li>
              </ul>
            </div>
        </nav>
    

   <header class='backgroundInscription' id="heroSign">
        <div class="flexHead center">
        <h1 id="signin">Inscription</h1>
        <div>
			<form method = "post" action = "">
				<div class="wrapperIn">
					<label>
						<input name='courriel' type="text" required="required"/>
						<span>Courriel</span>
						<i class="fa fa-envelope"></i>
					</label>
					<label>
						<input name='nomUtilisateur' type="text" required="required"/>
						<span>Nom utilisateur</span>
						<i class="fa fa-user"></i>
					</label>
					<label>
						<input name='motDePasse' type="password" required="required"/>
						<span>Mot de passe</span>
						<i class="fa fa-lock"></i>
					</label>
				</div>
			</form>
        </div>
        <div class="wrapperInb">
			<input type="submit" id="ipJoin" value="Inscription">
            <p>ou</p>
            <input onClick="window.location.href='connexion.php'" type="submit" id="ipSignIn" value="Connexion">
        </div>
        </div>
    </header>
	<!-- 
	
 
    <!-- jQuery -->
    <script src="app/assets/lib/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="app/assets/lib/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="app/assets/lib/script.js"></script>

</body>

</html>
