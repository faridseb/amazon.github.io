<?php

$servername = "localhost";
$database = "scl";
$username = "root";
$password = "";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    

    $requete = "SELECT * FROM article";
    $resultat = $bdd->query($requete);
    $articles = $resultat->fetchAll(PDO::FETCH_ASSOC);

    
}

catch(PDOException $e){
    echo "ERREUR" .$e->getMessage();
}









?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach($articles as $article) {?> 
        <article class="box">
            <img src="<?=$article['prod_img']?>" alt="" class="productimg">
            <h2 class="product-title"><?=$article['nom']?></h2>
            <div class="product-price"><?= $article['price']?></div>
            <button class="addcart">AJOUTER AU PANIER</button>
        </article>

        <?php  } ?>
</body>
</html>