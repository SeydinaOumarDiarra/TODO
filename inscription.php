<!DOCTYPE html>
<html>
<head>
    <title>INSCRIPTION</title> 
    <meta charset="utf-8"> 
</head>
<body>
    <?php include './header.php'; ?>
 <div class="content">
    <h1>Inscription sur TODO<h1>
       
        <form method="post" class="box">
            <p>Nom</p>
            <input type="text" name="nom">
            <p>Prenom</p>
            <input type="text" name="prenom">
            <p>Nom d'utilisateur</p>
            <input type="text" name="username">
            <p>Mot de passe</p>
            <input type="password" name="password">
            <p>Répetez votre password</p>
            <input type="password" name="repeatpassword"><br><br>
            <input type="submit" name="submit" value="Valider">
       
        </form>
    </div>  
</body>
</html>



<?php

include './bd.php';

            if(isset($_POST['nom'],$_POST['prenom'],$_POST['username'],$_POST['password'],$_POST['repeatpassword']))
            {
				
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$repeatpassword = $_POST['repeatpassword'];
             
                if($_POST['nom']&&$_POST['prenom']&&$_POST['username']&&$_POST['password']&&$_POST['repeatpassword']){
                 
                 
                if($password==$repeatpassword){
                     
                  $sql = "INSERT INTO utilisateur(nomUser,prenomUser,login,password) 
                            VALUES(:nom, :prenom, :username, :password)";

                    $query = $conn->prepare($sql);

                 //print_r($query);
                $datas = array(":nom"=>$nom ,":prenom"=>$prenom, ":username"=>$username, ":password"=>$password);

                $query->execute($datas);
                 
                }else echo"les 2 password doivent etre identique";
                 
                 
                 
            } else echo"Veuillez saisir tous les champs";
             
            }

?>
