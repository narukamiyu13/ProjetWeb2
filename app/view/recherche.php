<!DOCTYPE html>

<html lang="fr">
   <head>
      <meta charset="utf-8">
      <title>recherche</title>
      <link href="app/assets/style.css" rel="stylesheet">
      <!--<link href="app/assets/bootstrap.min.css" rel="stylesheet"> -->
      <link href="app/assets/reset.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 

      <script src="app/assets/js/menu.js"></script>
       
   </head>
   
   <body id="page-top">
      <?php include_once'header.php'; ?>
      <div class='black' >
         <div class="entete">
            <h2>
            Vous avez faim mais vous savez ne pas quelle recette faire? <br><br>Choisissez une categorie de recette et on vous proposera nos meilleures recettes!
             </h2>
         </div>
      </div>
      
     
         <div class='categorie' > 
            <div class="box1">  
                <h3>Entrées</h3>
                <img src="app/assets/images/entre.jpg" height="300" width="300"><br>
                <input name='optionCategorie' id="optionEntre"  type="radio" value='2'>
             </div>
             <div class="box1"> 
                 <h3>Repas Principal</h3>
                 <img src="app/assets/images/plat.jpg" height="300" width="500" ><br>
                 <input name='optionCategorie' id="optionPlat" type="radio" value='1'   ><br>
                 
            </div>
             <div class="box1"> 
                
                <h3>Dessert</h3>
                 <img src="app/assets/images/dessert.jpg" height="300" width="300"><br>
                 <input name='optionCategorie' id="optionDessert" type="radio" value='3'>
             </div>    
             
             
          </div>
          
      
      
     
          <div id='contenu'>
              
          </div>           
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
    <script>  
 $(document).ready(function(){  
      $('#optionPlat').click(function(){  
            var idCategorie = $(this).val();  
            //console.log('yo'); 
            //console.log(idCategorie);
            $.ajax({  
                url:"ajaxRecherche.php",  
                method:"POST",  
                data:{idCategorie:idCategorie},  
                success:function(data){  
                     $('#contenu').html(data);  
                }
                
           });
      }); 
     
     $('#optionDessert').click(function(){  
            var idCategorie = $(this).val();  
            //console.log('yo'); 
            //console.log(idCategorie);
            
            $.ajax({  
                url:"ajaxRecherche.php",  
                method:"POST",  
                data:{idCategorie:idCategorie},  
                success:function(data){  
                     $('#contenu').html(data);  
                }
                
           });
      });
     
     $('#optionEntre').click(function(){  
            var idCategorie = $(this).val();  
            //console.log('yo'); 
            //console.log(idCategorie);
            
            $.ajax({  
                url:"ajaxRecherche.php", 
                method:"POST",  
                data:{idCategorie:idCategorie},  
                success:function(data){  
                     $('#contenu').html(data);  
                }
                
           });
      });
 });  
 </script>
<?php include'footer.php'?>