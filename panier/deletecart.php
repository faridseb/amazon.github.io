<?php 

include "../connect.php";

$id = $_GET['id'];
$id_cl = $_SESSION['utilisateur']['id'];

$requete = $bdd->prepare("DELETE FROM session WHERE clt_id=? AND prod_id=? ");


$requete->execute(
    array($id_cl,$id)
);

header("location: index.php");




?>