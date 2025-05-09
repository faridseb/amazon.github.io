<?php 

include "../connect.php" ;

$id = $_GET['id'];


$requete = "SELECT * FROM produit WHERE id_prod=$id";

$resultat  = $bdd->query($requete);


$prods = $resultat->fetch(PDO::FETCH_ASSOC);





if(isset($_POST['ready'])){
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];

    $requete = $bdd->prepare("UPDATE produit SET lib_prod=? , prix_prod=? , prod_cat=? WHERE id_prod=? ");
    $requete->execute(
        array($nom,$prix,$categorie,$id)
    );
    header("location:produits.php");

}



?>

























<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style2.css">
    <title>Amazon Shop</title>
</head>
<body style="display: flex;justify-content: center;align-items: center;height: 100vh;">


<form action="" method="POST" style="box-shadow:1px 5px 14px black;">
    <div class="contenu">
        <h2 style="border-bottom:2px solid black;">AJOUTER UN PRODUIT</h2>
        <div class="box">
            <label for="">Nom de l'article :</label>
            <input type="text" name="nom" required value="<?=$prods['lib_prod']?>">
        </div>
        <div class="box">
            <label for="">Prix :</label>
            <input type="text" name="prix" required value="<?=$prods['prix_prod']?>">
        </div>
        <div class="box" style="margin: 20px 0 ;">
            <label for="">Categorie</label>
            <select name="categorie" id="">
                <option value="1">LIGA</option>
                <option value="2">LIGUE1</option>
                <option value="3">SERIEA</option>
                <option value="4">PREMIERE LEAGUE</option>
                <option value="5">BUNDESLIGA</option>
                <option value="6">SELECTION</option>
            </select>
        </div>
        <div class="box1" style="margin: 20px;">
            <input type="submit" name="ready" id="">
        </div>
    </div>
</form>
</body>
</html>