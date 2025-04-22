<?php

include "connect.php";

    if(isset($_POST['ok'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']) ;


        if(!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($mdp) ){
                        if($nom == " " or $prenom == " "){
                            $erreur = "LE CHAMP DOIT CONTENIR DES CARACTERE" ;
                        }
                        else{
                            $reqEmail = $bdd->prepare("SELECT * FROM client WHERE email = ?");
                        $reqEmail->execute(
                            array($email)
                        );
                        if($reqEmail->rowCount() == 0 ){
                                if(strlen($_POST['mdp']) < 4){
                                    $erreur = "Le mot de passe doit etre compris entre 4 ET 12 caracteres";
                                }
                                else{
                                    $requete = $bdd->prepare("INSERT INTO client(Nom,Prenom,email,mdp) VALUES (?,?,?,?)");
                                    $requete->execute(
                                        array($nom,$prenom,$email,$mdp)
                                    );
                                    $message = 'INSCRIPTION REUSSI' ;
                                    header("location:login.php"); 
                                }
                            
                        }
                        else{
                            $erreur = 'CET EMAIL EXISTE DEJA';
                        }
                        }
                        
                    }

    else{
        $erreur = 'VEUILLER REMPLIR TOUS LES CHAMPS' ;
    }

    }



?>














<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item " href="login.php"><i class="fa-solid fa-right-to-bracket"></i> se connecter</a>
                                <a class="dropdown-item btn btn-light" href="sng.php"> <i class="fa-solid fa-plus"></i>creer un compte</a>
                            </div>
                        </div>
                    </li>
                    <li><i class="fa-solid fa-bag-shopping" data-quantity="0" ></i></li>
                    <li>
                        
                        <div class="dropdown show" id="show2">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <?php if(!isset($_SESSION['utilisateur'])){ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                                <a class="dropdown-item" href="login.php"> PAS DE PROFIL </a>
                                <a class="dropdown-item " href="login.php"> <i class="fa-solid fa-right-to-bracket"></i> Se Connecter</a>
                            </div>
                            <?php }else{ ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                                <a class="dropdown-item" href="profil.php"><?= $_SESSION['utilisateur']['nom'] ?> <?= $_SESSION['utilisateur']['prenom'] ?></a>
                                <a class="dropdown-item " href="deconnect.php">se Deconnecter</a>
                            </div>
                            <?php } ?>
                        </div>
                        
                    </li>
                    <i class="fa-solid fa-circle-xmark" id="icones"></i>
                    <p class="droit">Copyright &copy;2024 Design by <span class="designer">RID</span></p>
                </ul> 
            </div>
            <i class="fa-solid fa-bag-shopping" id="Open" data-quantity="0"></i>
            <i class="fa-solid fa-magnifying-glass" id="icon2"></i>
            <i class="fa-solid fa-bars" id="icones2"></i>
            
        </nav>
        <div class="cart">
            <h2>Cart</h2>
            <div class="cartcontent">
                
            </div>
            <i class="fa-solid fa-xmark" ></i>
            <div class="total">
                <div class="total-title">Total</div>
                <div class="total-price">0 f</div>
            </div>
            <div class="btn">
                <a href="comp.php" class="buy-btn">FINALISER</a>
            </div>
            
        </div>
        <div class="search">
            <input type="search" placeholder="RECHERCHE...">
            <i class="fa-solid fa-magnifying-glass"></i>
            <i class="fa-solid fa-xmark" id="croix"></i>
        </div>
        
    </header>
    <form action="" method="POST">
        <div class="con" style="margin: 0px; background-color: black; padding: 40px ; color: white;"><h1>INSCRIPTION</h1></div>
        
        <div class="container">
        <?php
                if(isset($erreur)){
                    echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:red; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$erreur.'</p>';
                }

                if(isset($message)){
                    echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:green; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$message.'</p>';
                }

            ?> 
            <div class="box">
                <label for="">NOM* :</label>
                <input type="text" placeholder="NOM" name="nom" required>
            </div>
            <div class="box">
                <label for="">PRENOM* :</label>
                <input type="text" placeholder="PRENOM" name="prenom" required>
            </div>
            <div class="box">
                <label for="">Email* :</label>
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="box">
                <label for="">Creer un mot de passe :</label>
                <input type="password" placeholder="PASSWORD" name="mdp" required>
            </div>
            
            <div class="box1">
                <input type="submit" value="Creer le compte" name="ok">
            </div>
        </div>
    </form>

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
                <li><a href="">Selection nationale</a></li>
            </ul>
        </div>
        <div class="sec3">
            <h3>Follow us</h3>
            <ul>
                <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
        <p class="droit">Copyright &copy;2024 Design by <span class="designer">RID</span></p>
    
    </footer>


    <script src="script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</body>
</html>