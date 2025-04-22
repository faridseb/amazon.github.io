<?php 


include "connect.php" ;

$id_pro = $_GET['id'];


$requete = "SELECT * FROM produit WHERE id_prod=$id_pro";

$resultat = $bdd->query($requete);

$produit = $resultat->fetch(PDO::FETCH_ASSOC);


$nom = $produit['lib_prod'] ;
$prix = $produit['prix_prod'] ;
$img =  $produit['img_prod'] ;
$prod_id =  $produit['id_prod'] ;
$clt_id = $_SESSION['utilisateur']['id'] ;

$requete2 = "SELECT * FROM session WHERE prod_id=$id_pro";

$resultat2 = $bdd->query($requete2);

if($resultat2->rowCount() == 1){
    header("location:panier.php");
}


else{
    $requete = $bdd->prepare("INSERT INTO session(nom_p,prix_p,img_p,prod_id,clt_id) VALUES(?,?,?,?,?)");

$requete->execute(
    array($nom,$prix,$img,$prod_id,$clt_id)
);


header("location:panier.php");
}


?>

