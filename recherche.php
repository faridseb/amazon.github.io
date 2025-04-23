<?php

include "connect.php";


try{
    $search = $_POST['nom_a'];
    $requete2 = 'SELECT * FROM produit WHERE lib_prod LIKE "%'.$search.'%"';
    $resultat2 = $bdd->query($requete2);
    $products2 = $resultat2->fetchAll(PDO::FETCH_ASSOC);
    $images = $product2['img_prod'] ;
    $libs = $product2['lib_prod'] ;
    $prix = $product2['prix_prod'] ;

    if($resultat2){
        echo json_encode([
            'success' => true,
            'message' => 'VEUILLEZ REMLIR TOUS LES CHAMPS' ,
            'images' => $images ,
            'libs' => $libs ,
            'prix' => $prix 
        ]);
        exit;
    }else{
        echo json_encode([
            'success' => false,
            'message' => 'Aucun resultat trouver'
        ]);
        exit();
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