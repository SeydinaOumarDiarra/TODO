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
            <p>Nom Tâche</p>
            <input type="text" name="nom">
            <p>Date début</p>
            <input type="Date" name="date_debut">
            <p>Date fin</p>
            <input type="Date" name="date_fin">
            <p>Statut</p>
            <select name="etat" id="etat">
                <option value="">--Choisissez le status--</option>
                <option value="debut">Début</option>
                <option value="en cours">En cours</option>
                <option value="fin">Terminée</option>
            </select>
            <p>Description</p>
            <input type="textarea" name="description" rows="10" cols="50">
            <br><br>
            <input type="submit" name="submit" value="Valider">
        </form>
    </div>
</body>
</html>




<?php

include './bd.php';
             

            if(isset($_POST['nom'],$_POST['date_debut'],$_POST['date_fin'],$_POST['etat'],$_POST['description']))
            {
                if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = strip_tags($_GET['id']);
                //print_r($id);exit();
				
				$nom = $_POST['nom'];
				$date_debut = $_POST['date_debut'];
				$date_fin = $_POST['date_fin'];
				$etat = $_POST['etat'];
                $description = $_POST['description'];
				session_start();

				//print_r($idUser);exit();
                if($nom&&$date_debut&&$date_fin&&$etat&&$description){
                     
                  $sql = "INSERT INTO tache(nomTache,descriptionTache,date_debut,date_fin,etat,idProjet,idPhase) 
                            VALUES(:nomTache, :descriptionTache, :date_debut, :date_fin, :etat, :idProjet, :idPhase)";

                  $sql_projet = 'SELECT * FROM etape WHERE idPhase=:idPhase';
                  $query_projet = $conn->prepare($sql_projet);
                  $query_projet->bindValue(':idPhase', $id, PDO::PARAM_INT);
                  $query_projet->execute();
                  $resultatProjet = $query_projet->fetchAll(PDO::FETCH_ASSOC); 
                  $idProjet = $resultatProjet[0]['idProjet'] ;
                  //print_r($idProjet);exit();
                   
                 $query = $conn->prepare($sql);
                 
                    $datas = array(":nomTache"=>$nom ,":descriptionTache"=>$description,":date_debut"=>$date_debut, 
                        ":date_fin"=>$date_fin, ":etat"=>$etat,"idProjet"=>$idProjet, "idPhase"=>$id);
                   //print_r($datas);exit();

                $query->execute($datas);
				
				

                //$results = $query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['projet'] = $datas;
                //print_r($_SESSION['projet']);exit();

                header('location:ajoutProjet.php');exit();          
              }   
                 
            } else echo"Veuillez saisir tous les champs";
             
            }

?>