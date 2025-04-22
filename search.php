<?php

include "connect.php";








if(isset($_POST['yes'])){
    if(!isset($_SESSION['utilisateur'])){
        header("location:login.php");
    }
    else{
        header("location:comp.php");
    }
}

if(isset($_POST['nom_a'])){
    $search = $_POST['nom_a'];
    $requete = 'SELECT * FROM produit WHERE lib_prod LIKE "%'.$search.'%"';
    $resultat = $bdd->query($requete);
    $products = $resultat->fetchAll(PDO::FETCH_ASSOC);
}



if(isset($_SESSION['utilisateur'])){

    $id_s = $_SESSION['utilisateur']['id'] ;
    
    $requete5 = "SELECT * FROM session WHERE clt_id=$id_s  ";
    $resultat3 = $bdd->query($requete5);
    $products3  = $resultat3->fetchAll(PDO::FETCH_ASSOC);
    
    $requete8 = "SELECT COUNT(*) AS total FROM session WHERE clt_id=$id_s ";
    
    $reponse3 = $bdd->query($requete8);
    
    $NBR = $reponse3->fetch(PDO::FETCH_ASSOC);
    
    $requete9 = "SELECT SUM(prix_p) AS total2 FROM session WHERE clt_id=$id_s ";
    
    $reponse4 = $bdd->query($requete9);
    
    $NBR_p = $reponse4->fetch(PDO::FETCH_ASSOC);
    
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
    <link rel="stylesheet" href="style.css">
    <title>Amazon Shop</title>
</head>
<style>
    @media screen and(max-width:900px) {
        #icon2{
            display:none;
        }
    }
    #formu{

    }
</style>
<body>
    <header>
        <nav class="navbars" >
            <a href="index.php" class="logo"><span>A</span>MAZON SHOP</a>
            <div class="navlinks" >
                <ul>
                    <form action="" method="POST" id="formu">
                        <li><input type="search" placeholder="Rechercher" style="background-color:#f2f2f2;" name="nom_a">
                        <input type="submit" value="Envoyer" name="send" style="background-color:blue; color:white;">
                    </li>
                    </form>
                    <i class="fa-solid fa-bag-shopping" id="Open" data-quantity="0"></i>
                    <li>
                        <div class="dropdown show" id="show">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <?php if(!isset($_SESSION['utilisateur'])){ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                                <a class="dropdown-item" href="login.php"> PAS DE PROFIL </a>
                                <a class="dropdown-item " href="login.php"> <i class="fa-solid fa-key" style=" margin-right:7px; font-size:18px; color:black;"></i> Se Connecter</a>
                            </div>
                            <?php }else{ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                                <a class="dropdown-item" href="profil.php?id=<?=$_SESSION['utilisateur']['id']?>"><i class="fa-solid fa-user" style="color:black; margin-right:10px; font-size:20px;"></i><?= $_SESSION['utilisateur']['nom'] ?> <?= $_SESSION['utilisateur']['prenom'] ?></a>
                                <a class="dropdown-item " href="deconnect.php"><i class="fa-solid fa-right-to-bracket" style=" margin-right:10px; font-size:20px;"></i>se Deconnecter</a>
                            </div>
                            <?php } ?>
                        </div>
                    </li>
                    <li>
                        
                        <div class="dropdown show" id="show2">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <?php if(!isset($_SESSION['utilisateur'])){ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                                <a class="dropdown-item" href="login.php"> PAS DE PROFIL </a>
                                <a class="dropdown-item " href="login.php"> <i class="fa-solid fa-key" style=" margin-right:7px; font-size:18px;"></i> Se Connecter</a>
                            </div>
                            <?php }else{ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                                <a class="dropdown-item" href="profil.php"><i class="fa-solid fa-user" style="color:black; margin-right:10px; font-size:20px;"></i><?= $_SESSION['utilisateur']['nom'] ?> <?= $_SESSION['utilisateur']['prenom'] ?></a>
                                <a class="dropdown-item " href="deconnect.php"><i class="fa-solid fa-right-to-bracket" style=" margin-right:10px; font-size:20px;"></i>se Deconnecter</a>
                            </div>
                            <?php } ?>
                        </div>
                        
                    </li>
                    <i class="fa-solid fa-circle-xmark" id="icones"></i>
                    <p class="droit">Copyright &copy;2024 Design by <span class="designer">RID</span></p>
                </ul> 
            </div>
            <form action="" method="POST" id="icon2">
                        <li><input type="search" placeholder="Rechercher" style="background-color:#f2f2f2;" name="nom_a">
                        <input type="submit" value="Envoyer" name="send" style="background-color:blue; color:white;">
                    </li>
            </form>
            <!--<i class="fa-solid fa-magnifying-glass" ></i>-->
            <?php if(isset($_SESSION['utilisateur'])){ ?>
                        <li style="position:relative; top:30px; right:300px; font-size:30px;"><a href="panier.php"><i class="fa-solid fa-bag-shopping" data-quantity="<?=$NBR['total']?>" ></i></li>
                    <?php } else { ?>
                        <li><i class="fa-solid fa-bag-shopping" id="Open" data-quantity="0" ></i></li>
                    <?php } ?>
            <i class="fa-solid fa-bars" id="icones2"></i>
            
        </nav>
        <div class="cart">
            <h2>Cart</h2>
            <div class="cartcontent">
            <?php if(isset($_SESSION['utilisateur'])){ foreach($products3 as $product3) {?>
                <div class="cart-box">
                    <img src="<?=$product3['img_p']?>" alt="" class="imagez">
                    <div class="details-box">
                        <div class="title"><?=$product3['nom_p']?></div>
                        <div class="price"><?=$product3['prix_p']?></div>
                        <input type="number" value="1" class="quantity" name="qte">
                    </div>
                    <a href="deletecart.php?id=<?=$product3['prod_id']?>"><i class="fa-solid fa-trash"></i></a>
                </div>
                <?php } } else {
                    echo "";
                }?>
            </div>
            <i class="fa-solid fa-xmark" ></i>
            <div class="total">
                <div class="total-title">Total</div>
                <div class="total-price">0</div>
            </div>
            <div class="btn">
                <form action="" method="POST">
                <button class="buy-btn" name="yes">FINALISER</button>
                </form>
            </div>
            
        </div>

        
    </header>







    <section class="second">
            <section class="partenaire">
            <?php if(empty($_POST['nom_a'])) { ?>
                <h1 >AUCUNE RECHERCHE EFFECTUER</h1>

            <?php } else {foreach($products as $product){ ?>
            <article class="box" >
                <img loading="lazy" src="<?=$product['img_prod']?>" alt="" class="product-img">
                <h4 class="product-title"><?=$product['lib_prod']?></h4>
                <div class="product-price"><?=$product['prix_prod']?></div>
                <?php if(isset($_SESSION['utilisateur'])){ ?>
                    <button class="addcart"><a href="cart.php?id=<?=$product['id_prod']?>">AJOUTER AU PANIER</a></button>
                <?php } else { ?>
                    <button class="addcart"><a href="login.php">AJOUTER AU PANIER</a></button>
                <?php } ?>
            </article>
            <?php }} ?>
            </section>
    </section>


    
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