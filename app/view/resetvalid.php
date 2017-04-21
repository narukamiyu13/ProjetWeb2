<!DOCTYPE html>
<?php
/* -------------------------------------
| fichier resetvalid.php
| -------------------------
| CONTRIBUTEURS
|   Auteur: Cédrick Collin
|   Modifications: Cédrick Collin
| -------------------------
| DATES
|   Création: 19 avril 2017
|   Dernière Modification: 20 avril 2017
| -------------------------
| DESCRIPTION
|   VUE - La page a afficher dans le cas où le lien de réinitialisation
|   du mot de passe est valide et n'a pas expiré
|------------------------------------- */



?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>connexion</title>
    <link href="app/assets/style.css" rel="stylesheet">
    <!--<link href="app/assets/bootstrap.min.css" rel="stylesheet"> -->
	<link href="app/assets/reset.css" rel="stylesheet">
     <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="app/assets/js/menu.js"></script>
</head>


<?php// include_once("app/controller/controller.php");  ?>

    
<body id="page-top">
  <?php include_once'header.php'; ?>
    

   <header class='backgroundConnexion' id="heroSign">
        <div class="flexHead center">
        <h1 id="titreCI">Réinitialisation du mot de passe</h1>
       
			<form method = "POST" action = "resetPassword.php?uid=<?=$_GET['uid'] ?>&token=<?=$_GET['token'] ?>">
				<div class="wrapperIn">
					<label>
						<input name='password1' type="password" required="required"/>
						<span>Nouveau mot de passe</span>
						<i class="fa fa-user"></i>
					</label>
					<label>
						<input name='password2' type="password" required="required"/>
						<span>Re-taper le mot de passe</span>
						<i class="fa fa-lock"></i>
					</label>
				</div>
	
        <div class="wrapperInb">
            <input name="reset" type="submit" id="ipSignIn" value="Mettre à jour">
        </div>
        </div>
    </header>
	
	<?php include_once'footer.php'; ?>

 
    <!-- jQuery -->
    <script src="../assets/lib/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/lib/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../assets/lib/script.js"></script>

</body>

</html>
