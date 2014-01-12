<?php require_once 'include/connexion.inc.php';  // Connexion à la BDD ?>
<!-- En tête -->
<?php include_once "include/header.inc.php"; ?>

<div class="span8">
    <!-- notifications -->

    <!-- contenu -->


    <?php
    
    //************************LA PAGINATION*******************************************************
   $nbArticleParPage = 2;
   $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $sqlcount = ("SELECT COUNT(*) AS id_article FROM article WHERE publication=1");
    
    $result = mysql_query($sqlcount);
    $data = mysql_fetch_array($result);
    $total = $data['id_article'];
    
    $nbTotalDePage = ceil($total / $nbArticleParPage);
    $debut = ($page - 1) * $nbArticleParPage; // index de depart
    
    //$sql = ("SELECT id_article, contenu, titre, DATE_FORMAT(date, '%d/%m/%Y') as date FROM article WHERE publication=1 ORDER BY date DESC LIMIT $debut, $nbArticleParPage");
    for ($i=1; $i<=$nbTotalDePage; $i++)
    {
        echo "<a href='index.php?page=$i'>$i</a> ";
    }
    
   
 //******************************************LA RECHERCHE D'ARTICLES********************************************   
            

    if (isset($_GET['titre'])) 	{
	
        $recherche= $_GET['titre'];
		
        $sql = "select id_article,contenu,titre,DATE_FORMAT(date,'%d/%m/%Y') as date FROM article WHERE article.publication = 1 AND (article.titre like '%$recherche%' or article.contenu like '%$recherche%') ORDER BY article.contenu";
        $requete = mysql_query($sql);
        
// *************************************Compteur d'articles****************************************************
        $sql2 = "select count(*) as id_article from article where publication=1 and (titre like '%$recherche%' or contenu like '%$recherche%')";
        $result = mysql_query($sql2);
        $data = mysql_fetch_array($result);
        $total = $data['id_article'];
        if($total<1)
        echo "Il n'y a pas d'article correspondant.";
        else
        echo "Il y a ".$total." article(s).";  
        

        while ($ligne = mysql_fetch_array($requete)) {
            echo "<h2> $ligne[titre]</h2>$ligne[date] - ";
            echo " " . "$ligne[contenu]";
            echo "<img src = 'img/$ligne[id_article].jpg' width = '1024' height = '768' alt = '1'/>";
            echo "<a href ='formulaire.php?id_article=$ligne[id_article]'> Modifier un article </a>";
        }
    } 
    
    else {
        $sql = ("SELECT id_article, contenu, titre, DATE_FORMAT(date,'%d/%m/%Y') as date FROM article WHERE publication = 1 ORDER BY date LIMIT $debut, $nbArticleParPage"); //Afficher que 2 articles du plus récent au plus vieux
		$requete = mysql_query($sql);
        while ($ligne = mysql_fetch_array($requete)) {
		?>
		
           <a href="article.php?id=<?php echo $ligne['id_article']; ?>"><?php echo "<h2> $ligne[titre]</h2>";?></a>
		   <?php
		   echo "$ligne[date] - ";
            echo " " . "$ligne[contenu]";
            echo "<img src = 'img/$ligne[id_article].jpg' width = '1024' height = '768' alt = '1'/>";
            ?>
			<a href="article.php?id=<?php echo $ligne['id_article']; ?>">commenter</a>
			
			<?php
			if ($connect == TRUE)
			{
			echo"-";
			echo "<a href ='formulaire.php?id_article=$ligne[id_article]'> Modifier un article </a>";
			echo"-";
			?>
			<a href="supprimer_article.php?id=<?php echo $ligne['id_article']; ?>">Supprimer</a>
			
			<?php
			}
        }
    }
    ?>

</div>

<!-- Menu -->
<?php include_once "include/menu.inc.php"; ?>

<!-- Pied de page -->
<?php include_once "include/footer.inc.php"; ?>
