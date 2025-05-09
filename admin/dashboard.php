<?php

include "../connect.php";


$requete = "SELECT * FROM client ";

$reponse = $bdd->query($requete);

$utilisateurs = $reponse->fetchAll(PDO::FETCH_ASSOC);



$requete6 = "SELECT COUNT(*) AS total FROM client ";

$reponse = $bdd->query($requete6);

$NBR = $reponse->fetch(PDO::FETCH_ASSOC);


$requete7 = "SELECT COUNT(*) AS total FROM produit ";

$reponse2 = $bdd->query($requete7);

$NBR_prod = $reponse2->fetch(PDO::FETCH_ASSOC);


$requete8 = "SELECT COUNT(*) AS total FROM message ";

$reponse3 = $bdd->query($requete8);

$NBR_mess = $reponse3->fetch(PDO::FETCH_ASSOC);

$requete18 = "SELECT COUNT(*) AS total FROM commandes ";

$reponse13 = $bdd->query($requete18);

$NBR_com = $reponse13->fetch(PDO::FETCH_ASSOC);

$requete20 = "SELECT SUM(total_commande) AS total FROM commandes ";

$reponse20 = $bdd->query($requete20);

$chiffre = $reponse20->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="dash.css">
    
    <title>Admin</title>
</head>
<style>
    .container{
        /* display: flex; */
        display:grid;
        grid-template-columns: repeat(3,1fr);
        align-items:center;
        justify-content:center;
        position: relative;
        left:420px;
        width: 100vh;
    } 
    .respo{
        color:white;
    }
    .text{
        font-size:15px;
        font-weight:bold;
    }
    @media screen and (max-width:900px) {
    .container{
        display:grid;
        grid-template-columns: repeat(1,1fr);
        justify-content :center;
        align-items:center;
        width : 100% ;
        
    }
}
</style>
<body>
    <header>
        <h2><a href="dashboard.php">DASHBOARD</a></h2>
        <h3><a href=""><i class="fa-solid fa-user"></i> RID STACK</a></h3>
    </header>
    <div class="contenu">
        <aside>
            <div class="cont1">
                <a href="#" class="logo"><i class="fa-solid fa-house"></i><span class="respo">ACCEUIL</span></a>
            </div>
            <div class="cont1">
                <a href="clt.php" class="logo"> <i class="fa-solid fa-user"></i> <span class="respo">LISTES DES CLIENTS</span> </a>
            </div>
            <div class="cont1">
                <a href="commande.php" class="logo"> <i class="fa-solid fa-paper-plane"></i> <span class="respo">LISTES DES COMMANDES</span></a>
            </div>
            <div class="cont1">
                <a href="message.php" class="logo"><i class="fa-solid fa-message"></i> <span class="respo">MESSAGES DES CLIENTS</span> </a>
            </div>
            <div class="cont1">
                <a href="add.php" class="logo"><i class="fa-solid fa-plus"></i>  <span class="respo">AJOUTER UN PRODUITS</span> </a>
            </div>
            <div class="cont1">
                <a href="produits.php" class="logo"><i class="fa-solid fa-plus"></i>  <span class="respo">VOIR LES PRODUITS</span> </a>
            </div>
            <div class="cont1">
                <a href="../index.php" class="logo"><i class="fa-solid fa-right-from-bracket"></i>  <span class="respo">RETOUR AU SITE</span> </a>
            </div>
        </aside>
        <div class="container">
        <!--<div class="boxes">
                <div class="texte">Amazon <span style="color:blue;">dashboard</span></div>
                <button>Welcome !</button>
                
            </div>-->
            <div class="boxes">
                <div class="texte"><?=$NBR['total']?></div>
                <div class="text">Nombre des clients</div>
            </div>
            <div class="boxes">
                <div class="texte"><?=$NBR_com['total']?></div>
                <div class="text">Commandes</div>
            </div>
            <div class="boxes">
                <div class="texte"><?=$NBR_mess['total']?></div>
                <div class="text">Nombre de messages</div>
            </div>
            <div class="boxes">
                <div class="texte"><?=$NBR_prod['total']?></div>
                <div class="text">Listes des produits</div>
            </div>
            <div class="boxes">
                <div class="texte"><?=$chiffre['total']?>Fcfa</div>
                <div class="text">Chiffre d'affaires</div>
            </div>
        </div>
    </div>
    
</body>
</html>