<!--
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
NOM : 
PROJET : Foodie
ORGANISDATION : College Maisonneuve
PAGE : connexion.php
DATE DE CREATION : 27-03-17
DESCRIPTION : page connexion

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-->

<!DOCTYPE html>
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
    
   
    <body id="page-top">
        <?php include_once'header.php'; ?>
        <header class='backgroundConnexion' id="heroSign">
            <div class="flexHead center">
                <h1 id="titreCI">Connexion</h1>
                
                <form method = "POST" action = "connexion.php">
                    <div class="wrapperIn">
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
                    <p><a href="connexion.php?forgot">Mot de passe oublié?</a></p>
                    <div class="wrapperInb">
                        
                        <input onClick="window.location.href='inscription.php'" type="button" id="ipSignIn" value="Inscription">
                </form>
                    <p>ou</p>
                    <input name="bt_connexion" type="submit" id="ipJoin" value="Connexion">
                    
                    </div>
                <?php
                if($erreur==true){
                    echo "<p class=\"erreur\">Mauvais courriel ou mot de passe</p>";
                }
                ?>
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
