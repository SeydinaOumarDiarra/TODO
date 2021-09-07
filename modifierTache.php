<?php
include './bd.php';

if(isset($_POST)){
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['etat']) && !empty($_POST['etat'])
        && isset($_POST['date_debut']) && !empty($_POST['date_debut'])
        && isset($_POST['date_fin']) && !empty($_POST['date_fin'])){


        $id = strip_tags($_GET['id']);
        $nom = strip_tags($_POST['nom']);
        $etat = strip_tags($_POST['etat']);
        $date_debut = strip_tags($_POST['date_debut']);
        $date_fin = strip_tags($_POST['date_fin']);

        $sql = "UPDATE tache SET nomTache=:nom, etat=:etat, date_debut=:date_debut, date_fin=:date_fin WHERE idTache=:id;";

        $query = $conn->prepare($sql);

        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        $query->bindValue(':date_debut', $date_debut, PDO::PARAM_INT);
        $query->bindValue(':date_fin', $date_fin, PDO::PARAM_INT);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        header('Location: modifierTache.php');
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM tache WHERE idTache=:id;";

    $query = $conn->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des taches</title>
</head>
<body>
    <?php include './header.php'; ?>
<div class="content">
    <h1>Modifier une tâche</h1>
    <form method="post" class="box">
        <p>
            <label for="nom">Tâche</label><br>
            <input type="text" name="nom" id="nom" value="<?= $result['nomTache'] ?>">
        </p>
        <p>
            <label for="etat">Statut</label><br>
            <select name="etat" id="etat" value="<?= $result['etat'] ?>">
                <option value="">--Choisissez le status--</option>
                <option value="debut">Début</option>
                <option value="en cours">En cours</option>
                <option value="fin">Terminée</option>
            </select>
        </p>
        
        <p>
            <label for="date_debut">Date debut</label><br>
            <input type="Date" name="date_debut" id="date_debut" value="<?= $result['date_debut'] ?>">
        </p>
        <p>
            <label for="date_fin">Date fin</label><br>
            <input type="Date" name="date_fin" id="date_fin" value="<?= $result['date_fin'] ?>">
        </p>
        <p>
            <button>Enregistrer</button>
        </p>
        <input class="button" type="hidden" name="id" value="<?= $result['idTache'] ?>">
    </form>
</div>
</body>
</html>