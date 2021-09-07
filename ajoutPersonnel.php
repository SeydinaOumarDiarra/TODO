<!DOCTYPE html>
<html>
<head>
  <title>PROJET TODO</title>
   <meta charset="utf-8">
</head>
<body> 
    <?php include './header.php'; ?>
    <div class="content">
    <h1>Associer un personnel<h1>
       
        <form method="post" class="box">
            <p>
                <label for="nom"> Nom</label><br>
                <input type="text" name="nom">
            </p>
           
            <p>
                <label for="nom">Prénom</label><br>
                <input type="text" name="prenom">
            </p>
           
            <p>
                <label for="nom">Compétence</label><br>
                <select name="type" id="type">
                    <option value="">--Choisissez le type--</option>
                    <option value="developpeur">Developpeur</option>
                    <option value="deseigner">Deseigner</option>
                </select>
            </p>
            
            <br>
            <input type="submit" name="submit" value="AJOUTER">
        </form>
    </div>
</body>
</html>


<?php

include './bd.php';
             

            if(isset($_POST['nom'],$_POST['prenom'],$_POST['type']))
            {
                if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = strip_tags($_GET['id']);
                
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $type = $_POST['type'];
                session_start();

                

               
                //print_r($idUser);exit();
                if($nom&&$prenom&&$type){
                     
                $sql = "INSERT INTO utilisateur(nomUser,prenomUser,typeUser) 
                            VALUES(:nomUser, :prenomUser, :typeUser)";
                 
                 //creation du  personnel  
                $query = $conn->prepare($sql);
                $datas = array(":nomUser"=>$nom ,":prenomUser"=>$prenom, ":typeUser"=>$type);
                $query->execute($datas);

                //recuperation de l'id du personnel ajouté
                $sql2 = "SELECT MAX(idUSer) FROM utilisateur";
                $query2 = $conn->prepare($sql2);
                $query2->execute();
                $user = $query2->fetch(); 

                $idUser = $user[0];


                //insertion du personnel ajouté et de sa tache associée
                $sql3 = "INSERT INTO tache_utilisateur(idUser,idTache) 
                            VALUES(:idUser, :idTache)";
                $query3 = $conn->prepare($sql3);
                $datas3 = array(":idUser"=>$idUser, ":idTache"=>$id);
                $query3->execute($datas3);

                header('location:ajoutPersonnel.php'); exit();       
              }
                 
            } else echo"Veuillez saisir tous les champs";
             
            }

?>
