<?php
include "connect.php";
require_once('vendor/tecnickcom/tcpdf/tcpdf.php'); // Inclusion de TCPDF

// Vérifier si l'ID de la commande est défini dans la session
if (!isset($_SESSION['commande']['id_commande'])) {
    header("location: panier.php");
    exit();
}

$id_commande = $_SESSION['commande']['id_commande'];

// Récupérer les informations de la commande
$requete_commande = $bdd->prepare("SELECT * FROM commandes WHERE id_commande = ?");
$requete_commande->execute(array($id_commande));
$commande = $requete_commande->fetch(PDO::FETCH_ASSOC);

// Récupérer les détails de la commande
$requete_details = $bdd->prepare("SELECT * FROM details WHERE com_id = ?");
$requete_details->execute(array($id_commande));
$details = $requete_details->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations du client
$requete_client = $bdd->prepare("SELECT * FROM client WHERE id_clt = ?");
$requete_client->execute(array($commande['user_id']));
$client = $requete_client->fetch(PDO::FETCH_ASSOC);

// Création du PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Votre Boutique');
$pdf->SetTitle('Reçu de Commande');
$pdf->SetSubject('Reçu de Commande');
$pdf->AddPage();

// // Contenu du PDF
// $html = '
//     <h2 style="margin-top: 100px;">Reçu de Commande</h2>
//     <p style="margin-top: 100px;"><strong>Numéro de Commande:</strong> ' . $id_commande . '</p>
//     <p style="margin-top: 100px;"><strong>Date de Commande:</strong> ' . $commande['date_commande'] . '</p>
//     <p style="margin-top: 100px;"><strong>Nom du Client:</strong> ' . $client['Nom'] .' '. $client['Prenom'] . '</p>
//     <p style="margin-top: 100px;"><strong>Téléphone:</strong> ' . $client['Tel'] . '</p>
    
//     <p style="margin-top: 30px;><strong>Localisation:</strong> ' . $commande['localisation'] . '</p>
//     <p style="margin-top: 30px;><strong>Mode de Paiement:</strong> ' . $commande['paiement'] . '</p>
//     <table style="margin-top: 30px;">
//         <thead>
//             <tr style="border : 1px solid black ; padding :20px;">
//                 <th>Article</th>
//                 <th>Quantité</th>
//             </tr>
//         </thead>
//         <tbody>';

// foreach ($details as $detail) {
//     $html .= '
//             <tr style="border : 1px solid black ;padding :20px;">
//                 <td style="border : 1px solid black ;padding :20px;">' . $detail['lib_prod'] . '</td>
//                 <td style="border : 1px solid black ;padding :20px;">' . $detail['qte'] . '</td>
//             </tr>';
// }

// $html .= '
//         </tbody>
//     </table>
//     <p><strong>Total:</strong> ' . $commande['total_commande'] . ' FCFA</p>';

// $pdf->writeHTML($html, true, false, true, false, '');

// // Téléchargement du PDF
// $pdf->Output('recu_commande_' . $id_commande . '.pdf', 'I');
























$html = '
    <h2 style="text-align:center; font-size:30px;">Reçu de Commande</h2>
    <br><br>
    <p style="margin: 100px;"><strong>Numéro de Commande:</strong> ' . $id_commande . '</p>
    <br><br>
    <p style="margin: 100px;"><strong>Date de Commande:</strong> ' . $commande['date_commande'] . '</p>
    <br><br>
    <p style="margin: 100px;"><strong>Nom et Prenom du Client:</strong> ' . $client['Nom'] .' '. $client['Prenom'] . '</p>
    <br><br>
    <p style="margin: 100px;"><strong>Téléphone:</strong> ' . $client['Tel'] . '</p>
    <br><br>
    <p style="margin: 30px;"><strong>Localisation:</strong> ' . $commande['localisation'] . '</p>
    <br><br>
    <p style="margin: 30px;"><strong>Mode de Paiement:</strong> ' . $commande['paiement'] . '</p>
    <br><br>
    <table style="margin: 30px; border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="border: 1px solid black; background-color: #f2f2f2;">
                <th style="border: 1px solid black; padding: 8px; text-align: left;">Article</th>
                <th style="border: 1px solid black; padding: 8px; text-align: left;">Quantité</th>
            </tr>
        </thead>

        <tbody>';

foreach ($details as $detail) {
    $html .= '
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 8px; text-align: left;">' . $detail['lib_prod'] . '</td>
                <td style="border: 1px solid black; padding: 8px; text-align: left;">' . $detail['qte'] . '</td>
            </tr>';
}

$html .= '
        </tbody>
    </table>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>

    <p style="font-size:17px;"><strong>Total:</strong> ' . $commande['total_commande'] . ' FCFA</p>';

$pdf->writeHTML($html, true, false, true, false, '');

// Téléchargement du PDF
$pdf->Output('recu_commande_' . $id_commande . '.pdf', 'I');




























?>












