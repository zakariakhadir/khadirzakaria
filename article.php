<?php require_once 'include/connexion.inc.php';  // Connexion à la BDD ?>
<!-- En tête -->
<?php include_once "include/header.inc.php"; ?>

<div class="span8">
    
<?php
 if(!isset($_GET['id']))
 {
 header('Location: index.php');
 }
 else
 {
 $id_GET = intval($_GET['id']);
 }
 $va = mysql_query('SELECT * FROM article WHERE id_article = "'.$id_GET.'"');
 $line = mysql_fetch_array($va) ;
			echo "<h2> $line[titre]</h2>$line[date] - ";
            echo " " . "$line[contenu]";
            echo "<img src = 'img/$line[id_article].jpg' width = '1024' height = '768' alt = '1'/>";
			echo "<a href ='formulaire.php?id_article=$line[id_article]'> Modifier un article </a>";
			echo "-";
			
?>

			<a href="supprimer_article.php?id=<?php echo $line['id_article']; ?>">Supprimer</a>
<br/>
<hr/>
<?php

//*************************************affichage commentaire
 $vb = mysql_query('SELECT * FROM commentaires WHERE id_article = "'.$line['id_article'].'"');
 while($info_com = mysql_fetch_array($vb)) { ?>
 <h4> commentaire par  <?php echo $info_com['auteur']; ?> : </h4>
 <?php echo nl2br(htmlspecialchars($info_com['commentaire'])); ?><br/><br/>
 
 
 
                
 <?php
 }

 ?>
 <?php
 if (isset($_POST['envoyer'])){
    $id_article = $id_GET;
    $auteur = $_POST['auteur'];
    $comment = $_POST['comment'];
$req = "INSERT INTO commentaires(id, auteur, commentaire, id_article ) VALUES('', '$auteur', '$comment', '$id_article')";
    mysql_query($req);  ?>
	<SCRIPT language="JavaScript"> 
window.location.reload() 
</script> 

	<?php
}
	
    ?>
 
 <hr/>
 <form action="" method="post" ">
              
                auteur
                <br/><input type="text" name ="auteur" value=" "></input><br/>
                commentaire<br/>
                <textarea name ="comment" ></textarea>
 <br><input type="submit" name="envoyer" value="envoyer" class="btn btn-large btn-primary"></input>

 
 
 
			</div>
            
        
    
<!-- Menu -->
<?php include_once "include/menu.inc.php"; ?>

<!-- Pied de page -->
<?php include_once "include/footer.inc.php"; ?>
 