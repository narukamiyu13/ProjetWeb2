<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="app/assets/style.css" rel="stylesheet">
    <link href="app/assets/bootstrap.min.css" rel="stylesheet">
     <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php include_once("app/controller/controller.php");  ?>

    
<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">FOODIE</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#download">Découvrez</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#features">Features</a>
                    </li>
            
                    <li>
                        <a class="page-scroll">Join/Sign-in</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

   <header id="heroSign">
        <div class="backgroundInscription flexHead center">
        <h1 id="signin">Inscription</h1>
        <div>
        <div class="wrapperIn">
			<label>
                <input type="text" required="required"/>
                <span>Courriel</span>
                <i class="fa fa-envelope"></i>
            </label>
            <label>
                <input type="text" required="required"/>
                <span>Nom utilisateur</span>
                <i class="fa fa-user"></i>
            </label>
            <label>
                <input type="password" required="required"/>
                <span>Mot de passe</span>
                <i class="fa fa-lock"></i>
            </label>
            </div>
        </div>
        <div class="wrapperInb">
			<input type="submit" id="ipJoin" value="Inscription">
            <p>ou</p>
            <input onClick="window.location.href='sign-in.php'" type="submit" id="ipSignIn" value="Connexion">
        </div>
        </div>
    </header>

 
    <!-- jQuery -->
    <script src="assets/lib/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/lib/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="assets/lib/script.js"></script>

</body>

</html>
