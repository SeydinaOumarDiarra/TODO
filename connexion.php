<!DOCTYPE html>
<html>
<head> 
    <title>Authentification</title> 
    <meta charset="utf-8"> 
</head>
<body>
   
<h1>Authentification<h1>
   
    <form method="post">
        <p>Nom d'utilisateur</p>
        <input type="text" name="username">
        <p>Mot de passe</p>
        <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Valider">
   
    </form>
</body>
</html>


<?php

include './bd.php';
            //récupération PROPRE des variables AVANT de les utiliser
              $username = !empty($_POST['username']) ? trim($_POST['username']) : NULL;
              $password = !empty($_POST['password']) ? trim($_POST['password']) : NULL;

              //print_r($password);
              
              //preparer un message d'erreur
              $errMsg = array();

              //initialiser la session
              session_start();

            if(isset($_POST['username'],$_POST['password']))
            {
             
                if($username&&$password)
                {
                 
                    //preparation de la requete
                $sql = 'SELECT idUser,nomUser,prenomUser,login,password FROM  utilisateur WHERE login = :username AND password = :password';
                $datas = array(':username'=>$username , ':password'=>$password);

                //execution de la requete
                 try
                 {
                        $records = $conn->prepare($sql);
                        $records->execute($datas);
                  }
                  catch(Exception $e)
                  {
                    echo "<p>Erreur : " . $e->getMessage() . "</p>";
                    exit();
                  }

                      $results = $records->fetchAll(PDO::FETCH_ASSOC);
    
                        if(count($results) > 0 ){
                            

                            //mettre l'utilisateur connecté en session
                            $_SESSION['user'] = $results;
                           //print_r($_SESSION['user']);exit();

                            //redirection vers la page d'accueil de TODO
                            header('location:accueilTODO.php');
                        }else{
                            $errMsg[] = 'Vérifiez vos identifiants de connexion<br>';
							               header('location:connexion.php'); exit();
                        }

                 
                } else echo"Veuillez saisir tous les champs";
             
            }

?>