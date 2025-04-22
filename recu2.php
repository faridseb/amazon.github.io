<?php
require_once __DIR__ . '/vendor/autoload.php'; 






include "connect.php";


$id_com = $_SESSION['utilisateur']['id'];

// $requete = "SELECT * FROM session WHERE clt_id=$id_com  ";
// $resultat = $bdd->query($requete);
// $products = $resultat->fetchAll(PDO::FETCH_ASSOC);



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



$id_comm = $_SESSION['commande']['id_commande'];



$requete_c = "SELECT * FROM commandes
            JOIN client ON client.id_clt = commandes.user_id
            JOIN details ON details.com_id = commandes.id_commande
            JOIN produit ON produit.id_prod = details.prod_id
            WHERE id_commande=1";

$resultat_c = $bdd->query($requete_c);
$products = $resultat_c->fetchAll(PDO::FETCH_ASSOC);























// Exemple de données de commande (remplacez par vos propres données)
// $numeroCommande = 12345;
// $dateCommande = '2023-10-27';
// $nomClient = 'John Doe';
// $articles = [
//     ['nom' => 'Produit A', 'quantite' => 2, 'prix' => 10.00],
//     ['nom' => 'Produit B', 'quantite' => 1, 'prix' => 25.00],
// ];
// $total = 45.00;

// Création d'un nouvel objet TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Définition des informations du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Votre entreprise');
$pdf->SetTitle('Reçu de commande');
$pdf->SetSubject('Reçu de commande');
$pdf->SetKeywords('Reçu, commande');

// Suppression des en-têtes et pieds de page par défaut
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Ajout d'une page
$pdf->AddPage();

// Définition de la police
$pdf->SetFont('helvetica', '', 12);

// Contenu du reçu
$html = '

<div class="container">
<div class="head">
    <a href="#" class="logo"><span>A</span>MAZON SHOP</a>
    <p>Recu de la commande</p>
</div>
<div class="contenu">
    <div class="container2">
        <table style=" width:200px;
        border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>quantite</th>
                </tr>
            </thead>
            <tbody>
';

foreach($products as $product){ 
    $html .= '
        <tr>
        
        <td><?='.$product['lib_prod'].'</td>
        <td><?='.$product['prix_prod'].'</td>
        <td>'.$product['qte'].'</td>
        </tr>
    ';
}

$html .= '
</tbody>
</table>
<div class="total">
    <p name="total">Total : '. $NBR_p['total2'] .'</p>
</div>
</div>
</div>

<div class="end">
<p class="droit">Copyright &copy;2024 Design by <span class="designer">RID</span></p>
</div>
</div>
';

// Écriture du contenu HTML dans le PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Envoi du PDF au navigateur pour téléchargement
$pdf->Output('recu_commande.pdf', 'I');
?>