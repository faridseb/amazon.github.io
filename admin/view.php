<?php

include "../connect.php";



/*

$requete1 = "SELECT SUM(prix_p*qte_p) AS total2 FROM session WHERE clt_id=$id_com ";

$reponse1= $bdd->query($requete1);

$NBR_p = $reponse1->fetch(PDO::FETCH_ASSOC);

$requete3 = "SELECT prix_p ,qte_p ,(prix_p*qte_p) as totalU FROM session ";
$reponse4= $bdd->query($requete3);  
$total_u = $reponse4->fetch(PDO::FETCH_ASSOC);

$requete2 = $bdd->prepare("SELECT * FROM client WHERE id_clt=? ");
$requete2->execute(
    array($id_com)
);
$user= $requete2->fetch(PDO::FETCH_ASSOC);
*/

$id = $_GET['id'];

$requete_c = "SELECT * FROM commandes
            JOIN client ON client.id_clt = commandes.user_id
            JOIN details ON details.com_id = commandes.id_commande
            JOIN produit ON produit.id_prod = details.prod_id
            WHERE id_commande=$id";

$resultat_c = $bdd->query($requete_c);
$products = $resultat_c->fetchAll(PDO::FETCH_ASSOC);


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
<style>
    .ensemble{
        display: block;
        box-shadow:1px 5px 14px black;
        margin-top :30px;
        padding: 15px;
        border-radius:10px;
    }
    .container{
        display: grid ;
        grid-template-columns: repeat(2,1fr);
    }
    .container .box div{
        font-weight:bold;
    }
</style>
<body>
    <header>
        <a href="commande.php" style="font-size: 30px;">VOIR COMMANDE</a>
    </header>
    <div class="ensemble" >
            <div class="container2">
                    <table>
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>quantite</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products as $product){ ?>
                            <tr>
                                <td><img src="../images/<?=$product['img_prod']?>" alt=""></td>
                                <td><?=$product['lib_prod']?></td>
                                <td><?=$product['prix_prod']?></td>
                                <td><?=$product['qte']?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="total">
                        <p name="total">Total : <?=$product['total_commande']?></p>
                    </div>
            </div>
                <div class="container">
                    
                    <div class="box">
                        <div>Nom :</div>
                        <?=$product['Nom']?>
                    </div>
                    <div class="box">
                        <div>Prenom :</div>
                        <?=$product['Prenom']?>
                    </div>
                    <div class="box">
                        <div>Ville :</div>
                        <?=$product['ville']?>                 
                    </div>
                    <div class="box">
                        <div>Localisation :</div>
                        <?=$product['localisation']?>
                    </div>
                    <div class="box">
                        <div>Methode de paiement :</div>
                        <?=$product['paiement']?>
                    </div>
                </div>
        </form>
        
    </div>

</body>
</html>