<?php

include "connect.php";


$id = $_SESSION['utilisateur']['id'] ;

$requete1 = "SELECT SUM(prix_p*qte_p) AS total2 FROM session WHERE clt_id=$id_s ";

$reponse1= $bdd->query($requete1);

$prix = $reponse1->fetch(PDO::FETCH_ASSOC);

$prix_t = $prix['total2'];

$requete = $bdd->prepare("INSERT INTO commande(total_com) VALUES(?) ")


?>