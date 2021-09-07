<!DOCTYPE html>
<html>
<head>
  <title>PROJET TODO</title>
   <meta charset="utf-8">
</head>
<body> 
    <?php include './header.php'; ?>
    <div class="content">
        <h1>Créer un projet<h1>
           
            <form method="post" class="box">
                <p>
                    <label for="nom"> Nom du projet</label><br>
                    <input type="text" name="nom">
                </p>
                
                <p>
                     <label for="nom">Date début</label><br>
                     <input type="Date" name="date_debut">
                </p>
                
                <p>
                    <label for="nom">Date fin</label><br>
                    <input type="Date" name="date_fin">
                </p>
                
                <p>
                    <label for="nom">Statut</label><br>
                    <select name="etat" id="etat">
                        <option value="">--Choisissez le status--</option>
                        <option value="debut">Début</option>
                        <option value="avance">Avancé</option>
                        <option value="fin">Fin</option>
                    </select>
                </p>
                
                <br>
                <input type="submit" name="submit" value="ENREGISTRER">
            </form>
    </div>
</body>
</html>




<?php

include './bd.php';
             

            if(isset($_POST['nom'],$_POST['date_debut'],$_POST['date_fin'],$_POST['etat']))
            {
				
				$nom = $_POST['nom'];
				$date_debut = $_POST['date_debut'];
				$date_fin = $_POST['date_fin'];
				$etat = $_POST['etat'];
				session_start();

				$user = $_SESSION['user'];
				$idUser = $user[0]['idUser'];
				//print_r($idUser);exit();
                if($nom&&$date_debut&&$date_fin&&$etat){
                     
                  $sql = "INSERT INTO projet(nomProjet,date_debut,date_fin,etat, idUser) 
                            VALUES(:nomProjet, :date_debut, :date_fin, :etat, :idUser)";

                   
                 $query = $conn->prepare($sql);
                 //print_r($query);
                    $datas = array(":nomProjet"=>$nom ,":date_debut"=>$date_debut, ":date_fin"=>$date_fin, ":etat"=>$etat, "idUser"=>$idUser);

                $query->execute($datas);
				
				

                //$results = $query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['projet'] = $datas;
                //print_r($_SESSION['projet']);exit();

                header('location:accueilTODO.php');exit();          
                 
                 
            } else echo"Veuillez saisir tous les champs";
             
            }

?>