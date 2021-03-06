<!DOCTYPE html>
<?php
?>
<html lang="fr">
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


 <?php // include_once("app/controller/controller.php");  ?> 

    
<body id="page-top">
	<?php include_once'header.php'; ?>
    

   <header class='backgroundInscription' id="heroSign">
        <div class="flexHead center">
        <h1 id="titreCI">Inscription</h1>
        <div>
			<form method = "POST" action = "inscription.php">
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
			
        </div>
        <div class="wrapperInb">
			<input name="bt_inscription" type="submit" id="ipJoin" value="Inscription">
			</form>
            <p>ou</p>
            <input onClick="window.location.href='connexion.php'" type="submit" id="ipSignIn" value="Connexion">
        </div>
        </div>
    </header>
	
	<?php include_once'footer.php'; ?>
	
	
 
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
