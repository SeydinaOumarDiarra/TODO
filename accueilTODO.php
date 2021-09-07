
<?php

include './bd.php';       

              //initialiser la session
              session_start();
               
              $user = $_SESSION['user'];
              $idUser = $user[0]['idUser'];
              
                            //preparation de la requete
                            $sql = 'SELECT * FROM projet WHERE idUser = :idUser';
                            $records = $conn->prepare($sql);
                            // On attache les valeurs
                            $records->bindValue(':idUser', $idUser, PDO::PARAM_INT);
                            $records->execute();

                            // On stocke le résultat dans un tableau associatif
                            $resultat = $records->fetchAll(PDO::FETCH_ASSOC);  
//print_r($resultat);exit();                          
                           
                            
                            //$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil TODO</title>
    <meta charset="utf-8">
</head>

<body>
<?php include './header.php'; ?>

<br><br>
      <a class="button" href="ajoutProjet.php" style="float:right">NEW PROJET</a><p></p>
<br/><br/>
<div class="content">
<table>
    <thead>
        <th>Nom du PROJET</th>
        <th>Status du Projet</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php
          foreach($resultat as $result){
        ?>
            <tr>
                <td><?= $result['nomProjet'] ?></td>
                <td><?= $result['etat'] ?></td>
                <td><a href="detailProjet.php?id=<?= $result['idProjet'] ?>">Voir</a>  <a href="edit.php?id=<?= $result['idProjet'] ?>">Modifier</a>  <a href="delete.php?id=<?= $result['idProjet'] ?>">Supprimer</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>
</body>
</html>

