<?php
session_start();

// On inclut la connexion à la base
require_once('bd.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    //$idProjet = strip_tags($_GET['id']);

    // On écrit notre requête
    $sql = 'SELECT * FROM etape WHERE idPhase=:id';
    $sql_tache = 'SELECT * FROM tache WHERE idPhase=:idPhase';

    // On prépare la requête
    $query = $conn->prepare($sql);
    $query_tache = $conn->prepare($sql_tache);

    // On attache les valeurs
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query_tache->bindValue(':idPhase', $id, PDO::PARAM_INT);
  

    // On exécute la requête
    $query->execute();
    $query_tache->execute();

    // On stocke le résultat dans un tableau associatif
    $phase = $query->fetch();
    $tache = $query_tache->fetchAll(PDO::FETCH_ASSOC); 
    //print_r($phase);exit(); 

}

//require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet : <?= $phase['nomPhase'] ?></title>

</head>
<body>
    <?php include './header.php'; ?>
<div class="content">
    <p><a href="ajoutTache.php?id=<?= $phase['idPhase'] ?>" class="button" style ="float: right;">New Tâche</a>
    <h1>Phase : <?= $phase['nomPhase'] ?></h1>
    <p>Status phase : <?= $phase['etat'] ?></p>
    <p>Date Début : <?= $phase['date_debut'] ?></p>
    <p>Date Fin : <?= $phase['date_fin'] ?></p>


<table>
    <thead>
        <th>Tâches associées</th>
        <th>Etat tâche</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php
          foreach($tache as $result){
        ?>
            <tr>
                <td><a href="detailTache.php?id=<?= $result['idTache'] ?>"><?= $result['nomTache'] ?></a></td>
                <td><a href="detailTache.php?id=<?= $result['idTache'] ?>"><?= $result['etat'] ?></a></td>
                <td><a href="modifierTache.php?id=<?= $result['idTache'] ?>">Modifier</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>
</body>
</html>