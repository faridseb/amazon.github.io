<?php

include "connect.php";




if(isset($_SESSION['utilisateur'])){
    
    
$id_session = $_SESSION['utilisateur']['id'] ;


$requete1 = "SELECT SUM(prix_p*qte_p) AS total2 FROM session WHERE clt_id=$id_session ";
$reponse1= $bdd->query($requete1);
$prix = $reponse1->fetch(PDO::FETCH_ASSOC);


$requete5 = "SELECT * FROM session WHERE clt_id=$id_session";
$resultat3 = $bdd->query($requete5);
$products3  = $resultat3->fetchAll(PDO::FETCH_ASSOC);


$requete8 = "SELECT COUNT(*) AS total FROM session WHERE clt_id=$id_session ";
$reponse3 = $bdd->query($requete8);
$NBR = $reponse3->fetch(PDO::FETCH_ASSOC);


}

/*
if(isset($_POST['okay'])){
    $id_s = $_SESSION['utilisateur']['id'] ;
    
    foreach($products3 as $product3){  
    $id_P = $product3['prod_id'];
    $qte = $_POST['qte']['$id_P'];

    $requete10 = $bdd->prepare("UPDATE session SET qte_p=?  WHERE  clt_id=? AND prod_id=?");
    $requete10->execute(
        array($qte,$id_s,$id_P)
    );
    echo "id_prod". $id_P ;
    var_dump($qte) ;

    header("location:comp.php");
    }
    


}
*/
if (isset($_POST['okay'])) {
    $id_s = $_SESSION['utilisateur']['id'];

    foreach ($products3 as $product3) {
        $id_P = $product3['prod_id'];

        // Vérifie si une quantité a été soumise pour ce produit
        if (isset($_POST['qte'][$id_P])) {
            $qte = $_POST['qte'][$id_P]; // Récupère la nouvelle quantité

            $requete10 = $bdd->prepare("UPDATE session SET qte_p = ? WHERE clt_id = ? AND prod_id = ?");
            $requete10->execute([$qte, $id_s, $id_P]);
        }
    }

    header("Location:comp.php");
    exit();
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
    <link rel="stylesheet" href="style3.css">
    <title>Amazon Shop</title>
</head>
<body>
    <header>
        <nav class="navbars" >
            <a href="index.php" class="logo"><span>A</span>MAZON SHOP</a>
            <div class="navlinks" >
                <ul>
                    <li><i class="fa-solid fa-house" id="maison"></i> <a href="index.php" id="texte"> Acceuil</a></li>
                    <li>
                        
                        <div class="dropdown show ">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-futbol"></i>Catalogue
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="PL.php"> <img src="PRL.jpg" alt=""  class="PL">Premier league</a>
                                <a class="dropdown-item" href="LIGA.php"><img src="LIGAE.png" alt="" class="PL">LIGA</a>
                                <a class="dropdown-item" href="L1.php"><img src="Ligue-1.png" alt="" class="PL">LIGUE1</a>
                                <a class="dropdown-item" href="SA.php"><img src="SEIE.png" alt="" class="PL">SERIE A</a>
                                <a class="dropdown-item" href="BUND.php"><img src="Bundesliga.jpg" alt="" class="PL">BUNDESLIGA</a>
                                <a class="dropdown-item" href="SEL.php"><img src="euro.png" alt="" class="PL">SELECTION</a>
                            </div>
                        </div>
                    </li>
                    <li> <i class="fa-solid fa-phone" id="phone"></i> <a href="#contact" id="texte">  Contacts</a></li>
                    <li>
                        <i class="fa-solid fa-magnifying-glass"></i>
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
                    <?php if(isset($_SESSION['utilisateur'])){ ?>
                        <li><i class="fa-solid fa-bag-shopping" data-quantity="<?=$NBR['total']?>" ></i></li>
                    <?php } else { ?>
                        <li><i class="fa-solid fa-bag-shopping" data-quantity="0" ></i></li>
                    <?php } ?>
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
            <i class="fa-solid fa-magnifying-glass" id="icon2"></i>
            <?php if(isset($_SESSION['utilisateur'])){ ?>
                        <li><i class="fa-solid fa-bag-shopping" id="Open"data-quantity="<?=$NBR['total']?>" ></i></li>
                    <?php } else { ?>
                        <li><i class="fa-solid fa-bag-shopping" id="Open"data-quantity="0" ></i></li>
                    <?php } ?>
            <i class="fa-solid fa-bars" id="icones2"></i>
            
        </nav>
        <div class="search">
            <div>
                <form action="" method="POST" id="formu">
                    <input type="search" placeholder="RECHERCHE..." name="nom_a" style="width:300px;">
                    <input type="submit" value="envoyer" style="background-color:blue; color:white; cursor:pointer;">
                </form>
                <i class="fa-solid fa-xmark" id="croix"></i>
            </div>
            <div class="populs">
            <?php if(empty($_POST['nom_a'])) { ?>
                <h1 >AUCUNE RECHERCHE EFFECTUER</h1>

            <?php } else {foreach($products2 as $product2){ ?>
            <article class="box" style="background-color:white;">
                <img loading="lazy" src="<?=$product2['img_prod']?>" alt="" class="product-img">
                <h4 class="product-title"><?=$product2['lib_prod']?></h4>
                <div class="product-price"><?=$product2['prix_prod']?></div>
                <?php if(isset($_SESSION['utilisateur'])){ ?>
                    <button class="addcart"><a href="cart.php?id=<?=$product2['id_prod']?>">AJOUTER AU PANIER</a></button>
                <?php } else { ?>
                    <button class="addcart"><a href="login.php">AJOUTER AU PANIER</a></button>
                <?php } ?>
            </article>
            <?php }} ?>
            </div>
        </div>
        
    </header>
    <h2>PANIER</h2>
    <div class="ensemble">
        
            <div class="container2">
                <form action="" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>quantite</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody class="cartcontent">
                        <?php foreach($products3 as $product3){ ?>
                            <tr class="cart-box">
                                <td><img src="<?=$product3['img_p']?>" alt=""></td>
                                <td class="title"><?=$product3['nom_p']?></td>
                                <td class="price"><?=$product3['prix_p']?></td>
                                <td><input type="number"  value="1" class="quantity" style="border:1px solid black;" name="qte[<?=$product3['prod_id']?>]"></td>
                                <td><a href="deletecart.php?id=<?=$product3['prod_id']?>"><i class="fa-solid fa-trash" style="font-size:25px;"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="action">
                        <input type="submit" name="okay">
                    </div>
                </form>

                <div class="total">
                    <p>Total :</p>
                    <div class="total-price"></div>
                </div>
                
            </div>
        
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