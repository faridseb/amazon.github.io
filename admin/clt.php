<?php

include "../connect.php";


$requete = "SELECT * FROM client ";

$reponse = $bdd->query($requete);

$utilisateurs = $reponse->fetchAll(PDO::FETCH_ASSOC);




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
        max-width:1900px;
        margin-top:50px;
        margin-left:350px;
    }
    table tr td {
        padding: 10px 40px;
    }
    .respo{
        color:white;
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
                <a href="dashboard.php" class="logo"><i class="fa-solid fa-house"></i>ACCEUIL</a>
            </div>
            <div class="cont1">
                <a href="clt.php" class="logo"> <i class="fa-solid fa-user"></i>LISTES DES CLIENTS</a>
            </div>
            <div class="cont1">
                <a href="commande.php" class="logo"> <i class="fa-solid fa-paper-plane"></i>LISTES DES COMMANDE</a>
            </div>
            <div class="cont1">
                <a href="message.php" class="logo"><i class="fa-solid fa-message"></i>MESSAGES DES CLIENTS</a>
            </div>
            <div class="cont1">
                <a href="add.php" class="logo"><i class="fa-solid fa-plus"></i>AJOUTER UN PRODUITS</a>
            </div>
            <div class="cont1">
                <a href="produits.php" class="logo"><i class="fa-solid fa-plus"></i>  <span class="respo">VOIR LES PRODUITS</span> </a>
            </div>
            <div class="cont1">
                <a href="../index.php" class="logo"><i class="fa-solid fa-right-from-bracket"></i>RETOUR AU SITE</a>
            </div>
        </aside>
        <div class="container">
        <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach($utilisateurs as $utilisateur): ?>
                    <tr>
                    <td><?=$utilisateur['id_clt']?></td>
                    <td><?=$utilisateur['Nom']?></td>
                    <td><?=$utilisateur['Prenom']?></td>
                    <td><?=$utilisateur['email']?></td>
                    <td><?=$utilisateur['Tel']?></td>
                    </tr>
                <?php endforeach ;?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>