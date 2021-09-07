<!DOCTYPE html>
<html>
<head>
  <title>PROJET TODO</title>
   <meta charset="utf-8">
</head>
<body> 
     <?php include './header.php'; ?>
    <div class="content">
<h1>Créer une phase<h1>
   
    <form method="post" class="box">
        <p>Nom Phase</p>
        <input type="text" name="nom">
        <p>Date début</p>
        <input type="Date" name="date_debut">
        <p>Date fin</p>
        <input type="Date" name="date_fin">
        <p>Statut</p>
        <select name="etat" id="etat">
            <option value="">--Choisissez le status--</option>
            <option value="non terminee">Non Terminée</option>
            <option value="terminee">Terminéé</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="SUIVANT">
    </form>
    </div>
</body>
</html>


<?php

include './bd.php';
             

            if(isset($_POST['nom'],$_POST['date_debut'],$_POST['date_fin'],$_POST['etat']))
            {
                if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = strip_tags($_GET['id']);
                
                $nom = $_POST['nom'];
                $date_debut = $_POST['date_debut'];
                $date_fin = $_POST['date_fin'];
                $etat = $_POST['etat'];
                session_start();

                $user = $_SESSION['user'];
                $idUser = $user[0]['idUser'];

               
                //print_r($idUser);exit();
                if($nom&&$date_debut&&$date_fin&&$etat){
                     
                  $sql = "INSERT INTO etape(nomPhase,date_debut,date_fin,etat, idProjet) 
                            VALUES(:nomPhase, :date_debut, :date_fin, :etat, :idProjet)";

                   
                 $query = $conn->prepare($sql);
                 //print_r($query);
                    $datas = array(":nomPhase"=>$nom ,":date_debut"=>$date_debut, ":date_fin"=>$date_fin, ":etat"=>$etat, "idProjet"=>$id);

                $query->execute($datas);

                header('location:ajoutPhase.php');exit();          
              }
                 
            } else echo"Veuillez saisir tous les champs";
             
            }

?>
