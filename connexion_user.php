
<?php require_once 'include/connexion.inc.php';  // Connexion à la BDD      ?>

<?php require_once 'include/connexion.inc.php';  // Connexion à la BDD   ?>
<?php
//********* connexion users ************
if (isset($_POST['connecter'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $req = "SELECT * FROM users WHERE (email='$email' AND password = '$password')";
    
    $execute = mysql_query($req);
	$resultat = mysql_fetch_array($execute);
    if($resultat)
    {
       $sid = md5($resultat['email'] . time());
       $req1 = "UPDATE users SET sid = '$sid' WHERE email = '".$resultat['email']."'";
       mysql_query($req1);
      // print_r($req1);
        setcookie('sid', $sid, time() + 15*60);
		header('Location: index.php');
    }
    else {
        echo 'dehors !!';
}
} else {
?>

<!-- En tête -->
<?php include_once "include/header.inc.php"; ?>
<div class="span8">


    <h1> Connexion </h1>
    <br>
    <form action="connexion_user.php" method="post" enctype="multipart/form-data">
        Email
        <br><input type="text" name ="email" value=""></input>
        <br>
        Mot de passe
        <br><input type="password" name ="password" value=""></input>
        <br>
        <br><input type="submit" name="connecter" value="Se connecter" class="btn btn-default btn-primary"></input>
        <br>
        <br>
        </div>
        <!-- Menu -->
<?php include_once "include/menu.inc.php"; ?>

        <!-- Pied de page -->
<?php include_once "include/footer.inc.php";
}
?>


