<?php require_once 'include/connexion.inc.php';  ?>
<?php
 
 if(isset($_GET['id']))
 {
 $id=$_GET['id'];

$sql="DELETE FROM article WHERE id_article='$id'";
mysql_query($sql);
header('Location:index.php');
}
?>