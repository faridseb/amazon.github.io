<?php

include "../connect.php";



$requete = "SELECT * FROM produit  ";
$resultat = $bdd->query($requete);
$products  = $resultat->fetchAll(PDO::FETCH_ASSOC);












?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Amazon Shop</title>
</head>
<body>
    <div class="popul" style="margin:20px;">
        <h2  data-aos="zoom-in"><a href="dashboard.php">ARTICLES DE LA BOUTIQUE</a></h2>

        <section class="populaire" id="populaire">
            <?php foreach($products as $product){ ?>
            <article class="box" >
                <img loading="lazy" src="../images/<?=$product['img_prod']?>" alt="" class="product-img">
                <h4 class="product-title"><?=$product['lib_prod']?></h4>
                <div class="product-price"><?=$product['prix_prod']?> Fcfa</div>
                <button class="addcart" style="background-color:red;"><a href="deleteprod.php?id=<?=$product['id_prod']?>" style="color:white;">SUPPRIMER</a></button>
                <button class="addcart" style="background-color:green; margin-top:10px;"><a href="updateprod.php?id=<?=$product['id_prod']?>" style="color:white;">MODIFIER</a></button>
            </article>
            <?php } ?>

        </section>
    </div>


    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>