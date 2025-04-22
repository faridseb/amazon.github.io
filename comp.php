<?php

include "connect.php";


$id_com = $_SESSION['utilisateur']['id'];

$requete = "SELECT * FROM session WHERE clt_id=$id_com  ";
$resultat = $bdd->query($requete);
$products = $resultat->fetchAll(PDO::FETCH_ASSOC);



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



if(isset($_POST['right'])){
    $total = $NBR_p['total2'];
    $ville =$_POST['ville'];
    $localisation = htmlspecialchars($_POST['localisation']);
    $tel = htmlspecialchars($_POST['Tel']);
    $pay =$_POST['pay'];

    $requete = $bdd->prepare("INSERT INTO commandes VALUES (0,NOW(),?,?,?,?,?,?)");
    $requete->execute(
        array($total,$ville,$localisation,$tel,$pay,$id_com)
    );

    $id_comm = $bdd->lastInsertId();

    $_SESSION['commande'] = [
        'id_commande' => $id_comm 
    ];
    
    $requete5 = "SELECT * FROM session WHERE clt_id=$id_com";
    $resultat3 = $bdd->query($requete5);
    $products3  = $resultat3->fetchAll(PDO::FETCH_ASSOC);

    /*$requete_c = "SELECT * FROM commandes WHERE user_id=$id_com";
    $resultat_c = $bdd->query($requete_c);
    $com  = $resultat_c->fetch(PDO::FETCH_ASSOC);
    $id_comm  = $com['id_commande']; */
    

    foreach($products as $product){
        $monf = $product['nom_p'];
        $qte = $product['qte_p'];
        $prod_id = $product['prod_id'];   
        $requete = $bdd->prepare("INSERT INTO details VALUES (0,?,?,?,?)");
        $requete->execute(
        array($monf,$qte,$id_comm,$prod_id)
        );

        
    }
    
    $id = $_SESSION['utilisateur']['id'];
    $requete4 = $bdd->prepare("DELETE FROM session WHERE clt_id=?");
    $requete4->execute(
        array($id_com)
    );
    header("location:indexs.php");
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
    <link rel="stylesheet" href="style2.css">
    <title>Amazon Shop</title>
</head>
<body>
    <header>
        <a href="panier.php" style="font-size: 30px;">FINALISATION DE COMMANDE</a>
    </header>
    <div class="ensemble">
        <form action="" method="POST">
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
                                <td><img src="<?=$product['img_p']?>" alt=""></td>
                                <td><?=$product['nom_p']?></td>
                                <td><?=$product['prix_p']?></td>
                                <td><?=$product['qte_p']?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="total">
                        <p name="total">Total : <?=$NBR_p['total2']?></p>
                    </div>
            </div>
                <div class="container">
                    <h2>Informations de la commande</h2>
                    <div class="box">
                        <label for="">Vile</label>
                        <br>
                        <select name="ville" id="" required>
                            <option value="SOKODE">SOKODE</option>
                            <option value="LOME">LOME</option>
                            <option value="ATAKPAME">ATAKPAME</option>
                            <option value="KARA">KARA</option>
                            <option value="DAPAONG">DAPAONG</option>
                        </select>
                    </div>
                    <div class="box">
                        <label for="">Localisation(Quartier)</label>
                        <input type="text" name="localisation" placeholder="Ex : Zongo" value="<?=$user['Localisation']?>" required>
                    </div>
                    <div class="box">
                        <label for="">Numero de telephone</label>
                        <input type="text" name="Tel" placeholder="Ex : 90 33 33 33" value="<?=$user['Tel']?>" name="tel" required>
                    </div>
                    <div class="box">
                        <label for="">Mode de paiement :</label>
                        <br>
                        <select name="pay" id="" required>
                            <option value="Tmoney">TMoney</option>
                            <option value="Flooz">Flooz</option>
                        </select>
                    </div>
                    <div class="box1">
                        <input type="submit" value="Valider la commande" name="right">
                    </div>
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