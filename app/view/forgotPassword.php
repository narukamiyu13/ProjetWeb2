<!DOCTYPE html>
<?php

if(isset($_POST['recover'])){
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
    $PDO = new PDO("mysql:host=localhost;dbname=id1299011_foodie","id1299011_cedrick","pa14t336!0L",$options);
    $query = "SELECT COUNT(idUtilisateur) FROM utilisateur WHERE courriel='".$_POST['email']."'";
    $PDOStatement = $PDO->prepare($query);
    $PDOStatement->execute();
    $resultat = $PDOStatement->fetch(PDO::FETCH_NUM);
   // var_dump($resultat[0]);
    
    if($resultat[0] == 1){
        
        $conf = rand(1000,9999);
        $query = "SELECT idUtilisateur, prenom FROM utilisateur WHERE courriel='".$_POST['email']."'";
        $PDOStatement = $PDO->prepare($query);
        $PDOStatement->execute();
        $personne = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        
        
        $query = "INSERT INTO passwordResets (userID, confirmationCode) VALUES (".$personne['idUtilisateur'].", $conf)";
        $PDOStatement = $PDO->prepare($query);
        $PDOStatement->execute();
        
        
        $to      = $_POST['email'];
        $subject = 'R&eacute;initialisation du mot de passe';
        $message = 'Bonjour '.$personne['prenom'].',
        
        Si vous recevez ce courriel, c\'est que vous avez demandé une réinitialisation de votre mot de passe Foodie.

        Vous pouvez le faire en cliquant sur le lien ci-dessous

        http://cedrickcollin.me/foodie/resetPassword.php?uid='.$personne['idUtilisateur'].'&token='.$conf.'


        Cordialement,
        L\'équipe Foodie.';
        $headers = 'From: noreply@foodie.com';

        mail($to, $subject, $message, $headers);
    }
    
}



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
            <h1 id="titreCI">Mot de passe oublié</h1>
                 <?php
                    if(!isset($_POST['recover'])){
                ?>
                <form method = "POST" action = "connexion.php?forgot">
                    <div class="wrapperIn">
                        <label>
                            <input name='email' type="text" required="required"/>
                            <span>Courriel</span>
                            <i class="fa fa-user"></i>
                        </label>

                    </div>


            <div class="wrapperInb">
                <input name="recover" type="submit" id="recover" value="Envoyer courriel">
                </form>
            </div>
            </div>
       <?php
            } else {
                ?>
           <p>Merci. Si un compte existant est associé à l'adresse fournie, un courriel de réinitialisation sera envoyé.</p>
           <?php
                    }
           ?>
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
