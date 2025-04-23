<?php
include "connect.php";

try{
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);


        
        if(!empty($email) AND !empty($mdp)){
            if($email == "seboufarid43@gmail.com" && $_POST['mdp']=='admin'){
                $redirectUrl = 'dashboard.php' ;
                echo json_encode([
                    'success' => true,
                    'message' => 'Connexion réussie , Vous etes Admin',
                    'redirect' => $redirectUrl
                ]);
                exit();
            }
            else{
                $requete = $bdd->prepare("SELECT * FROM client WHERE  email=? AND mdp =?");
            $requete->execute(
                array($email,$mdp)
            );
            $reponse = $requete->rowCount();
            
            if( $reponse > 0){
                $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
                $id = $utilisateur['id_clt'];
                $nom_user  =  $utilisateur['Nom'];
                $prenom_user  =  $utilisateur['Prenom'];
                $_SESSION['utilisateur'] = [
                "id" => $id,
                "nom" => $nom_user,
                "prenom" => $prenom_user,
                "email" => $email ,
                "mdp" => $mdp
                ];
                // header("location:index.php");
                $redirectUrl = 'index.php' ;
                echo json_encode([
                    'success' => true,
                    'message' => 'Connexion réussie.',
                    'redirect' => $redirectUrl
                ]);
                exit();
            }
            else{
                // $erreur = 'EMAIL OU MOT DE PASSE INCORRECT';
                echo json_encode([
                    'success' => false,
                    'message' => 'EMAIL OU MOT DE PASSE INCORRECT'
                ]);
                exit;
            }
            }
            
        }
    else{
        // $erreur = 'VEUILLEZ REMLIR TOUS LES CHAMPS';
        echo json_encode([
            'success' => false,
            'message' => 'VEUILLEZ REMLIR TOUS LES CHAMPS'
        ]);
        exit;
    }





} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit();
}

?>