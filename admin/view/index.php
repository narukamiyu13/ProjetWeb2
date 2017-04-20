<?php
$errMsg = "&nbsp;";
if(isset($_GET['1478'])){
    $errMsg .="Vous devez entrer un nom d'utilisateur<br/>&nbsp;";
}
if(isset($_GET['9632'])){
    $errMsg .="Vous devez entrer un mot de passe<br/>&nbsp;";
}
if(isset($_GET['2584'])){
    $errMsg .="Les identifiants entrés sont incorrects";
}
?>
<html>
<head>
   <link href="css/style.css" rel="stylesheet">
</head>    
<body>
    <div class="wrapperConnexion">
        <p><?= $errMsg; ?></p>

        <form method="post" action="index.php">
            <label>
            <input class="inputForm" type="text" name="username" placeholder="Nom d'utilisateur" >
            </label>
            <label>
            <input class="inputForm" type="password" name="password" placeholder="Mot de passe" >
            </label>  
            <label><br>
            <input class='btConnexion' type="submit" name="connexion" value="Connexion" >
            </label>    

        </form>
    </div>    
</body>
    </html>
  