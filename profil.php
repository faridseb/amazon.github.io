<?php 

include "connect.php";

$idU = $_SESSION['utilisateur']['id'];

if(isset($_POST['ok'])){
    $ville = htmlspecialchars($_POST['ville']);
    $localisation = htmlspecialchars($_POST['localisation']);
    $tel = htmlspecialchars($_POST['tel']);
    if(!empty($ville) AND !empty($localisation) AND !empty($tel) ){
                                $requete = $bdd->prepare("UPDATE client SET Ville=?,localisation=?,tel=? WHERE id_clt=?");
                                $requete->execute(
                                    array($ville,$localisation,$tel,$idU)
                                );
                                header("location:index.php");
                                
                            }
else{
    $erreur = 'VEUILLER REMPLIR TOUS LES CHAMPS' ;
}

}

$idU = $_SESSION['utilisateur']['id'];



$requete2 = $bdd->prepare("SELECT * FROM client WHERE id_clt=? ");
$requete2->execute(
    array($idU)
);


$user= $requete2->fetch(PDO::FETCH_ASSOC);







?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="profil.css">
    <title>Amazon Shop</title>
</head>
<body>
    <header>
        <a href="index.php" style="font-size: 30px;">PROFIL UTILISATEUR</a>
    </header>
    <div class="ensemble">
    <div class="container">
        <form action="" method="POST">
            <div class="box">
                <label for="">Nom & Prenom</label>
                <input type="text" value="<?= $_SESSION['utilisateur']['nom'] ?> <?= $_SESSION['utilisateur']['prenom'] ?>" required  readonly>
            </div>
            <div class="box">
                <label for="">Email</label>
                <input type="text" value="<?= $_SESSION['utilisateur']['email']?>"  required name="" readonly>
            </div>
            <div class="box">
                <label for="">Ville</label>
                <br>
                <select  name="ville" id="" required >
                    <option value="SOKODE">SOKODE</option>
                    <option value="LOME">LOME</option>
                    <option value="ATAKPAME">ATAKPAME</option>
                    <option value="KARA">KARA</option>
                    <option value="DAPAONG">DAPAONG</option>
                </select>
            </div>
            <div class="box">
                <label for="">Localisation(Quartier)</label>
                <input type="text" placeholder="Ex : Zongo"  required name="localisation" value="<?=$user['Localisation']?>">
            </div>
            <div class="box">
                <label for="">Numero de telephone</label>
                <input type="text" placeholder="Ex : 90 33 33 33"  name="tel" required value="<?=$user['Tel']?>">
            </div>
            <div class="box1">
                <input type="submit" value="Envoyer les informations" name="ok">
            </div>
        </form>
        </div>
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
</body>
</html>