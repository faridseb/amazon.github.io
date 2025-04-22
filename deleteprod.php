<?php 

include "connect.php" ;

$id = $_GET['id'];


$requete = $bdd->prepare("DELETE FROM produit WHERE id_prod = ?");


$requete->execute(
    array($id)
);

header("location:produits.php");







?>