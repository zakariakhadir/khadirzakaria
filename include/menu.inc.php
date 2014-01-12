<?php
if ($connect == FALSE)
{
    ?> 
<nav class="span4">
    <h3>Menu</h3>
    
    <form action="index.php" method="get">
        <br><input type="text" name ="titre" value=""></input>
          <br><input type="submit" name="" value="Rechercher" class="btn btn btn-primary"</input>
                  
    </form>
    
    <ul>
        <br>
         <li><a href="index.php">Accueil</a></li>
         <li><a href="connexion_user.php">Se connecter</a></li>
    </ul>

</nav> 
<?php 
}
else 
    {
    ?>
<form class="titre_edito" action="deconnexion.php"> 
  <?php 
  echo "<strong>Vous etes connecté</strong>"; 
  ?> 
</form>
    <nav class="span4">
    <h3>Menu</h3>
    
    <form action="index.php" method="get">
        <br><input type="text" name ="titre" value=""></input>
          <br><input type="submit" name="" value="Rechercher" class="btn btn btn-primary"</input>
                  
    </form>
    
    <ul>
        <br>
         <li><a href="index.php">Accueil</a></li>
         <li><a href="formulaire.php">Ajouter un article</a></li>
         <li><a href="deconnexion_user.php">Déconnexion</a></li>
         <?php
    }    
         ?>


        
           
