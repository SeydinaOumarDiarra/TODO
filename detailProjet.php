<?php
session_start();

// On inclut la connexion à la base
require_once('bd.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    //$idProjet = strip_tags($_GET['id']);

    // On écrit notre requête
    $sql = 'SELECT * FROM projet WHERE idProjet=:id';
    $sql_phase = 'SELECT * FROM etape WHERE idProjet=:idProjet';

    // On prépare la requête
    $query = $conn->prepare($sql);
    $query_phase = $conn->prepare($sql_phase);

    // On attache les valeurs
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query_phase->bindValue(':idProjet', $id, PDO::PARAM_INT);
  

    // On exécute la requête
    $query->execute();
    $query_phase->execute();

    // On stocke le résultat dans un tableau associatif
    $projet = $query->fetch();
    $phase = $query_phase->fetchAll(PDO::FETCH_ASSOC); 
    //print_r($phase);exit(); 

}

//require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet : <?= $projet['nomProjet'] ?></title>

</head>
<body>
    <?php include './header.php'; ?>
<div class="content">
    <p><a href="ajoutPhase.php?id=<?= $projet['idProjet'] ?>" class="button" style ="float: right;">New phase</a>
    <h1>Projet : <?= $projet['nomProjet'] ?></h1>
    <p>Status projet : <?= $projet['etat'] ?></p>
    <p>Date Début : <?= $projet['date_debut'] ?></p>
    <p>Date Fin : <?= $projet['date_fin'] ?></p>

<table>
    <thead>
        <th>Phases associées</th>
    </thead>
    <tbody>
        <?php
          foreach($phase as $result){
        ?>
            <tr>
                <td><a href="detailPhase.php?id=<?= $result['idPhase'] ?>"><?= $result['nomPhase'] ?></a></td>
                <td><a href="detailPhase.php?id=<?= $result['idPhase'] ?>">Détail</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>



    </div>
</body>
</html>