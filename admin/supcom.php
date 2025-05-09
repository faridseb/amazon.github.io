<?php 

include "../connect.php" ;

$id = $_GET['id'];


$requete = $bdd->prepare("DELETE FROM commandes WHERE id_commande=?");


$requete->execute(
    array($id)
);

header("location:commande.php");







?>