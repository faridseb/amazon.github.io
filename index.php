<?php

include "connect.php";



$requete = "SELECT * FROM produit WHERE id_prod IN (1,2,31)  ";
$resultat = $bdd->query($requete);
$products  = $resultat->fetchAll(PDO::FETCH_ASSOC);



$requete1 = "SELECT * FROM produit WHERE id_prod IN (1,2,25,9,23,33,27,35)  ";
$resultat1 = $bdd->query($requete1);
$products1  = $resultat1->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['yes'])){
    if(!isset($_SESSION['utilisateur'])){
        header("location:login.php");
    }
    else{
        header("location:comp.php");
    }
}


if(isset($_POST['ok'])){
    if(!isset($_SESSION['utilisateur'])){
        header("location:login.php");
    }
    else{
        $id =  $_SESSION['utilisateur']['id'];
        $message = $_POST['text'];
        $email = $_SESSION['utilisateur']['email'];

        if( !empty($message) ){
            $requete2 = $bdd->prepare("INSERT INTO message(lib_mess,clt_id) VALUES(?,?)");
            $requete2->execute(
                array($message,$id)
            );  
            
            header("location:index.php");
            
        }
        else{
            $erreur = "REMPLIR TOUS LES CHAMPS";
        }
    }
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
<body>
    <header>
        <nav class="navbars" >
            <a href="#" class="logo"><span>A</span>MAZON SHOP</a>
            <div class="navlinks" >
                <ul>
                    <li><i class="fa-solid fa-house" id="maison"></i> <a href="index.php" id="texte"> Acceuil</a></li>
                    <li>
                        
                        <div class="dropdown show ">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-futbol"></i>Catalogue
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="ligues/PL.php"> <img src="PRL.jpg" alt=""  class="PL">Premier league</a>
                                <a class="dropdown-item" href="ligues/LIGA.php"><img src="LIGAE.png" alt="" class="PL">LIGA</a>
                                <a class="dropdown-item" href="ligues/L1.php"><img src="Ligue-1.png" alt="" class="PL">LIGUE1</a>
                                <a class="dropdown-item" href="ligues/SA.php"><img src="SEIE.png" alt="" class="PL">SERIE A</a>
                                <a class="dropdown-item" href="ligues/BUND.php"><img src="Bundesliga.jpg" alt="" class="PL">BUNDESLIGA</a>
                                <a class="dropdown-item" href="ligues/SEL.php"><img src="euro.png" alt="" class="PL">SELECTION</a>
                            </div>
                        </div>
                    </li>
                    <li> <i class="fa-solid fa-phone" id="phone"></i> <a href="#contact" id="texte">Contacts</a></li>
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
                        <li><a href="panier/"><i class="fa-solid fa-bag-shopping" data-quantity="<?=$NBR['total']?>" ></i></a></li>
                    <?php } else { ?>
                        <li><a href="login.php"><i class="fa-solid fa-bag-shopping" data-quantity="0" ></i></a></li>
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
                        <li><a href="panier.php"><i class="fa-solid fa-bag-shopping" id="Open"data-quantity="<?=$NBR['total']?>" ></i></a></li>
                    <?php } else { ?>
                        <li><i class="fa-solid fa-bag-shopping" id="Open"data-quantity="0" ></i></li>
                    <?php } ?>
            <i class="fa-solid fa-bars" id="icones2"></i>
            
        </nav>
        

        <div class="search">
            <div>
                <form action="" method="POST" id="loginForm">
                    <input type="search" placeholder="RECHERCHE..." name="nom_a" style="width:300px;">
                    <input type="submit" value="envoyer" style="background-color:blue; color:white; cursor:pointer;">
                </form>
                <i class="fa-solid fa-xmark" id="croix"></i>
            </div>
            <div class="populs" id="populs">
                
            </div>
        </div>
    </header>

    <section class="first">
        <div class="cole1" data-aos="fade-right">
            <h1>Bienvenue sur Amazon Shop</h1>
            <p>le site ou vous retrouverez tous vos maillot authentiques et recent.Vivez le football en plus grand avec les maillots de Amazon </p>
            <a href="#populaire">EXPLORER <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="cole2" data-aos="fade-left">
            <img src="image1.png" alt="" class="images1">
        </div>
    </section>


    <section class="carousel"  data-aos="zoom-in-up" id="carousel1">
        <h2  data-aos="zoom-in">APERCUS DES ARTICLES</h2>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="rs2.webp" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="arsenal.webp" alt="Second slide">
                    </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="livv.jpeg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="chelea.webp" alt="Third slide">
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    
    </section>
    <section class="carousel"  data-aos="zoom-in-up" id="carousel2">
        <h2  data-aos="zoom-in">APERCUS DES ARTICLES</h2>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="mbappe.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="lamine.jpg" alt="Second slide">
                    </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="haaland.jpg" alt="Third slide">
                </div>
                
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    
    </section>
    <h2 style="text-align:center;border-bottom: 2px solid black;width: 50%; margin: auto;">NOS CATEGORIES</h2>
    <div class="populs">
        <div class="box">
            <a href="PL.php">
                <p>PREMIERE L</p>
                <img src="PRL.jpg" alt="">
            </a>
        </div>
        <div class="box">
            <a href="LIGA.php">
                <p>LA LIGA</p>
                <img src="LIGAE.png" alt="">
            </a>
        </div>
        <div class="box">
            <a href="L1.php">
                <p>LIGUE1</p>
                <img src="Ligue-1.png" alt="">
            </a>
        </div>
        <div class="box">
            <a href="SA.php">
                <p>SERIEA</p>
                <img src="SEIE.png" alt="">
            </a>
            
        </div>
        <div class="box">
            <a href="BUND.php">
                <p>BUNDESLIGA</p>
                <img src="Bundesliga.jpg" alt="">
            </a>
        </div>
        <div class="box">
            <a href="SEL.php">
                    <p>SELECTIONS</p>
                    <img src="euro.png" alt="">
            </a>
        </div>
    </div>

    <div class="popul">
        <h2  data-aos="zoom-in">ARTICLE POPULAIRE</h2>

        <section class="populaire" id="populaire">
            <?php foreach($products as $product){ ?>
            <article class="box"  data-aos="fade-down-right">
                <img loading="lazy" src="images/<?=$product['img_prod']?>" alt="" class="product-img">
                <h4 class="product-title"><?=$product['lib_prod']?></h4>
                <div class="product-price"><?=$product['prix_prod']?><span> Fcfa</span></div>
                <?php if(isset($_SESSION['utilisateur'])){ ?>
                    <button class="addcart"><a href="cart.php?id=<?=$product['id_prod']?>">AJOUTER AU PANIER</a></button>
                <?php } else { ?>
                    <button class="addcart"><a href="login.php">AJOUTER AU PANIER</a></button>
                <?php } ?>
                
            </article>
            <?php } ?>
        </section>
    </div>

<div class="new">
    <h2  data-aos="zoom-in">SAVOIR PLUS</h2>
    <div class="informations">
        
        <div class="infos" data-aos="zoom-in-up">
            <img src="logoA.png" alt="">
            <p>Le maillot Adidas incarne l'alliance parfaite entre style et performance. Conçu pour les athlètes comme pour les amateurs de mode, ce maillot offre un confort exceptionnel et une coupe ajustée qui épouse les mouvements. Fabriqué à partir de matériaux de haute qualité, il est idéal pour toutes vos activités sportives et vos sorties décontractées.</p>
        </div>
        <div class="infos" data-aos="zoom-in-up">
            <img src="nike.png" alt="">
            <p>Optez pour le maillot Nike, synonyme de performance et de style. Conçu avec des matériaux de haute qualité, ce maillot vous offre un confort optimal et une liberté de mouvement inégalée. Que vous soyez sur le terrain ou en dehors, son design moderne et épuré vous permet de rester à la pointe de la mode.</p>
        </div>
        <div class="infos" data-aos="zoom-in-up">
            <img src="puma.png" alt="">
            <p>Le maillot Puma est bien plus qu'un simple vêtement de sport. Il combine innovation, confort, et style pour vous offrir une expérience unique. Que vous soyez sur le terrain ou en ville, ce maillot est conçu pour vous accompagner dans tous vos défis, avec une coupe ajustée et un design dynamique qui reflète l'esprit de la marque.</p>
        </div>
        <div class="infos" data-aos="zoom-in-up">
            <img src="fifa.png" alt="">
            <p>La Fédération Internationale de Football Association (FIFA), en tant que l'instance dirigeante du football mondial, joue un rôle clé dans la promotion de ce sport à travers le sponsoring, notamment en soutenant les équipes et les compétitions par le biais des maillots. La FIFA, reconnue pour son influence et son engagement à développer le football à l'échelle mondiale, associe son nom à des maillots qui sont portés par des millions de joueurs et de fans dans le monde entier.</p>
        </div>
    </div>
</div>

    <section class="second">
        <h2  data-aos="zoom-in">ARTICLE COMPLEMENTAIRE</h2>
            <section class="partenaire">
            <?php foreach($products1 as $product1){ ?>
                <article class="box" data-aos="zoom-in-up">
                    <img loading="lazy" src="images/<?=$product1['img_prod']?>" alt="" class="product-img">
                    <h5 class="product-title"><?=$product1['lib_prod']?></h5>
                    <div class="product-price"><?=$product1['prix_prod']?><span> Fcfa</span></div>
                    <?php if(isset($_SESSION['utilisateur'])){ ?>
                    <button class="addcart"><a href="cart.php?id=<?=$product1['id_prod']?>">AJOUTER AU PANIER</a></button>
                    <?php } else { ?>
                    <button class="addcart"><a href="login.php">AJOUTER AU PANIER</a></button>
                    <?php } ?>
                </article>
            <?php } ?>
            </section>
    </section>
    
    <div class="formulaire" id="contact" data-aos="fade-down">
        <h2>Nous Contacter</h2>
        <form action="" method="POST">
            <?php if(isset($_SESSION['utilisateur'])){ ?>
            <div class="box">
                <p>Email*</p>
                <input type="email" placeholder="ENTRER VOTRE EMAIL" name="email" required readonly value="<?=$_SESSION['utilisateur']['email']?>">
            </div>
            <?php } else { ?>
            <div class="box">
                <p>Email*</p>
                <input type="email" placeholder="ENTRER VOTRE EMAIL" name="email" required >
            </div>
            <?php } ?>
            <div class="box">
                <p>Message*</p>
                <textarea  id="" cols="23" rows="6" placeholder="ENTRER VOTRE MESSAGE" name="text" required></textarea>
            </div>
            <div class="box1">
                <input type="submit" value="Envoyer" name="ok">
            </div>
        </form>
    </div>   
    <footer>
        <div class="fin">
            <div class="sec1">
                <h3>Get help</h3>
                <ul>
                    <li><a href="">FAQ</a></li>
                    <li><a href="">shopping</a></li>
                    <li><a href=""></a></li>
                </ul>
            </div>
            <div class="sec2">
                <h3>Online shop</h3>
                <ul>
                    <li><a href="">Maillot domicile</a></li>
                    <li><a href="">Maillot Exterieur</a></li>
                    <li><a href="SEL.php">Selection nationale</a></li>
                </ul>
            </div>
            <div class="sec3">
                <h3>Follow us</h3>
                <ul>
                    <li><a  href="https://x.com/sebou_fari16891?t=BP7bHz1rhQgHE0iIMJtHjA&s=09"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="https://www.facebook.com/profile.php?id=100070130408601"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/rid_stack?igsh=MTg5czRqcTl0cG5rdQ=="><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <p class="droit">Copyright &copy;2024 Design by <span class="designer">RID</span></p>
    </footer>


    <script>





        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            try {
                const formData = new FormData(e.target);
                const response = await fetch('recherche.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                // Afficher la notification
                const notification = `
                        <article class="box" style="background-color:white;">
                        <img loading="lazy" src="${images}" alt="" class="product-img">
                        <h4 class="product-title">${lib}</h4>
                        <div class="product-price">${prix}<span style="color:blue;">Fcfa</span></div>
                        <?php if(isset($_SESSION['utilisateur'])){ ?>
                            <button class="addcart"><a href="cart.php?id=1">AJOUTER AU PANIER</a></button>
                        <?php } else { ?>
                            <button class="addcart"><a href="login.php">AJOUTER AU PANIER</a></button>
                        <?php } ?>
                        </article>
                `;

                const container = document.getElementById('populs');
                container.innerHTML = notification;
                


            } catch (error) {
                console.error('Erreur:', error);
            }
        });










    </script>
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