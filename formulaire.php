
<?php
require_once 'include/connexion.inc.php';  // Connexion à la BDD 

// AJOUT D'UN ARTICLE
if (isset($_POST['Ajouter'])) {
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];
    $date = date("Y") . '-' . date("m") . '-' . date("d");

    if (isset($_POST['publie']))
        $publie = $_POST['publie'];
    if ($titre != "" && $texte != "")
        $req = "INSERT INTO article(id_article, date, contenu, titre, publication ) VALUES('', '$date', '$texte', '$titre', '$publie')";
    mysql_query($req);
    if (!empty($_POST['image'])) {

        $erreur_image = $_FILES['image']['error'];
    }
    else
        $erreur_image = "";
// Retourne l id genere par la derniere requete
    $id = mysql_insert_id();

    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$id.jpg");


    echo $erreur_image;
    echo "Article ajouté : 0";
} 
else if (isset($_POST['Modifier'])){
    $id_article = $_POST['id_article'];
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];
    $date = date("Y") . '-' . date("m") . '-' . date("d");

    if (isset($_POST['publie']))
        $publie = $_POST['publie'];
    if ($titre != "" && $texte != "")
        $req = "UPDATE article SET date='$date', contenu='$texte', titre='$titre', publication='$publie' WHERE id_article='$id_article'";
    
    print_r($req);
    mysql_query($req);
     if (!empty($_POST['image'])) {

        $erreur_image = $_FILES['image']['error'];
    }
    else{
        $erreur_image = "";
    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__)."/img/$id_article.jpg");
    echo $id_article.".jpg";
    echo "Article modifié : 0)";
    }
}

//******************************** MODIFICATION D'UN ARTICLE*************************
if (isset($_GET['id_article'])) {
    $id= $_GET['id_article'];
    $sql = "SELECT * FROM article WHERE id_article= $id";
    $requete = mysql_query($sql);
    $data = mysql_fetch_array($requete);
    extract($data);
    

} else {
    $data = array("id_article" => NULL, "titre" => "", "contenu" => "", "publication" => "", "date" => "");
}
$action_label = (!empty($_GET['id_article'])) ? 'Modifier' : 'Ajouter';


    ?>

    <?php require_once 'include/connexion.inc.php';  // Connexion à la BDD  ?>

    <!-- En tête -->
    <?php include_once "include/header.inc.php"; ?>
    <div class="span8">
        <center><h2><font color="red"><?php echo $action_label ?> un article</font></h2>




            <form action="formulaire.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_article" value="<?php echo $data['id_article'] ?>" >
                Titre
                <br><input type="text" name ="titre" value="<?php echo $data['titre'] ?>"></input>
                <br>
                <br>
                Texte
                <br><textarea name ="texte" ><?php echo $data['contenu'] ?></textarea>
                <br>
                <br>
                Image
                <br>
                <br><input type="file" name="image" value="Choisissez un fichier"></input>
                <br>
                <br>
                Publi&eacute;   &nbsp;&nbsp;&nbsp; <input type="checkbox" name="publie" <?php if ($data['publication']==1){ ?> checked="checked" <?php } ?> value="1" ></input>
                <br>
                <br><input type="submit" name="<?php echo $action_label ?>" value="<?php echo $action_label ?>" class="btn btn-large btn-primary"></input>





            </form>
        </center>
    </div>
    <!-- Menu -->
    <?php include_once "include/menu.inc.php"; ?>

    <!-- Pied de page -->
    <?php include_once "include/footer.inc.php"; ?>

