<?php
session_start();

// On inclut la connexion à la base
require_once('bd.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    //$idProjet = strip_tags($_GET['id']);

    // On écrit notre requête
    $sql = 'SELECT * FROM tache WHERE idTache=:id';

    // On prépare la requête
    $query = $conn->prepare($sql);
    //$query_phase = $conn->prepare($sql_phase);

    // On attache les valeurs
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    //$query_phase->bindValue(':idProjet', $id, PDO::PARAM_INT);
  

    // On exécute la requête
    $query->execute();
    //$query_phase->execute();


    $sql2 = 'SELECT * FROM utilisateur,tache_utilisateur WHERE tache_utilisateur.idUser= utilisateur.idUser AND tache_utilisateur.idTache=:idTache';
    $query2 = $conn->prepare($sql2);
    $query2->bindValue(':idTache', $id, PDO::PARAM_INT);
    $query2->execute();
    $personnels = $query2->fetchAll(PDO::FETCH_ASSOC);
    //print_r($personnels);exit(); 

    // On stocke le résultat dans un tableau associatif
    $tache = $query->fetch();
    //$phase = $query_phase->fetchAll(PDO::FETCH_ASSOC); 
    //print_r($phase);exit(); 

}

//require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tache : <?= $projet['nomTache'] ?></title>

</head>
<body>
    <?php include './header.php'; ?>
<div class="content">
    <p><a href="ajoutPersonnel.php?id=<?= $tache['idTache'] ?>" class="button" style ="float: right;">New personnel</a>
    <h1>Tache : <?= $tache['nomTache'] ?></h1>
    <p>Status tache : <?= $tache['etat'] ?></p>
    <p>Date Début : <?= $tache['date_debut'] ?></p>
    <p>Date Fin : <?= $tache['date_fin'] ?></p>
    <p>Description : <?= $tache['descriptionTache'] ?></p>
<table>
    <thead>
        <th>Personnels associés</th>
    </thead>
    <tbody>
        <?php
         foreach($personnels as $result){
        ?>
            <tr>
                <td><?= $result['nomUser'] ?></td>
                <td><?= $result['prenomUser'] ?></td>
                <td><?= $result['typeUser'] ?></td>
            </tr>
           
        <?php
        }
        ?>
    </tbody>
</table>
</div>
</body>
</html>