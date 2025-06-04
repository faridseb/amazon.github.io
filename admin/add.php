<?php

$servername = "localhost";
$database = "amazon";
$username = "root";
$password = "";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    



    if(isset($_POST['ready'])){
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $image = $_POST['fileToUpload'];
        $catergorie = $_POST['categorie'];


    

        // Dossier où les images uploadées seront stockées
        $targetDir = "../images/";

        // Nom du fichier cible complet (chemin du dossier + nom du fichier original)
        $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1; // Indicateur pour savoir si l'upload est OK (1 = oui, 0 = non)
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Extension du fichier

        // Vérifier si le fichier image est une vraie image ou une fausse
        
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                // Le fichier est une image
                $uploadOk = 1;
            } else {
                // Le fichier n'est pas une image
                header("Location: index.html?status=error&msg=" . urlencode("Le fichier n'est pas une image."));
                exit();
                $uploadOk = 0;
            }
        

        // Vérifier si le fichier existe déjà
        if (file_exists($targetFile)) {
            header("Location: index.html?status=error&msg=" . urlencode("Désolé, le fichier existe déjà."));
            exit();
            $uploadOk = 0;
        }

        // Vérifier la taille du fichier (ici, max 500KB)
        if ($_FILES["fileToUpload"]["size"] > 500000) { // 500 KB = 500 * 1024 octets
            header("Location: index.html?status=error&msg=" . urlencode("Désolé, votre fichier est trop volumineux. (Max 500KB)"));
            exit();
            $uploadOk = 0;
        }

        // Autoriser certains formats de fichier
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            header("Location: index.html?status=error&msg=" . urlencode("Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés."));
            exit();
            $uploadOk = 0;
        }

        // Vérifier si $uploadOk est à 0 à cause d'une erreur
        if ($uploadOk == 0) {
            // Redirection avec un message d'erreur (déjà gérée par les 'exit()' ci-dessus)
        } else {
            // Si tout est OK, essayer d'uploader le fichier
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                // L'image a été uploadée avec succès
                // Redirection vers la page d'accueil avec un message de succès
                $requete = $bdd->prepare("INSERT INTO produit VALUES (0,?,?,?,?)");
                $requete->execute(
                array($nom,$prix,$image,$catergorie)
                );
                header("location:dashboard.php");
                exit();
            } else {
                // Erreur lors de l'upload
                header("Location: index.html?status=error&msg=" . urlencode("Désolé, une erreur est survenue lors de l'upload de votre fichier."));
                exit();
            }
        }



        
    }
}

catch(PDOException $e){
    echo "ERREUR" .$e->getMessage();
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
    <link rel="stylesheet" href="../style2.css">
    <title>Amazon Shop</title>
</head>
<body style="display: flex;justify-content: center;align-items: center;height: 100vh;">


<form action="" method="POST" style="box-shadow:1px 3px 4px black;">
    <div class="contenu" >
        <h2 style="border-bottom:1px solid black;">AJOUTER UN PRODUIT</h2>
        <div class="box">
            <label for="">Nom de l'article :</label>
            <input type="text" name="nom" required placeholder="Nom du produit">
        </div>
        <div class="box">
            <label for="">Prix :</label>
            <input type="text" name="prix" required placeholder="Prixdu produit">
        </div>
        <div class="box2">
            <label for="">Image du produit:</label>
            <input type="file" placeholder="Choisir" name="fileToUpload" required>
        </div>
        <div class="box" style="margin: 20px 0 ;">
            <label for="">Categorie</label>
            <select name="categorie" id="">
                <option value="1">LIGA</option>
                <option value="2">LIGUE1</option>
                <option value="3">SERIEA</option>
                <option value="4">PREMIERE LEAGUE</option>
                <option value="5">BUNDESLIGA</option>
                <option value="6">SELECTION</option>
            </select>
        </div>
        <div class="box1" style="margin: 20px;">
            <input type="submit" name="ready" id="">
        </div>
    </div>
</form>
</body>
</html>