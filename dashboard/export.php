<?php
// inclure le fichier de connexion à la base de données
require_once('../includes/db.php');

// requête SQL pour récupérer les données de la table 2023
$query = "SELECT * FROM `2023`";

// exécute la requête
$result = mysqli_query($conn, $query);

// créer le nom du fichier Excel
$filename = "table_2023_" . date('Ymd') . ".xls";

// en-tête pour indiquer que le contenu est un fichier Excel
header("Content-Type: application/vnd.ms-excel");

// en-tête pour indiquer le nom du fichier
header("Content-Disposition: attachment; filename=\"$filename\"");

// écriture de l'en-tête de la table
echo "ID\tMatricule\tCIN\tNom \tPrenom\tSexe\tDate de debut\tDate de fin\tDate de naissance\tNiveau d'etudes\tInstitut\tVille\tEmail\tTuteur\tRecommander\tLieu\tTelephone\tObservation\tMetier\tAnnees\tNature de stage\tService\tReference\n";

// boucle pour écrire les données de la table dans le fichier Excel
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['id'] . "\t" . $row['matricule'] . "\t" . $row['cin'] . "\t" . $row['nom'] ."\t" . $row['prenom'] . "\t" . $row['sexe'] . "\t" . $row['date_debut'] . "\t" . $row['date_fin'] . "\t" . $row['date_naissance'] . "\t" . $row['niveau_etude'] . "\t" . $row['institut'] . "\t" . $row['ville'] . "\t" . $row['email'] . "\t" . $row['tuteur'] . "\t" . $row['recommander'] . "\t" . $row['lieu'] . "\t" . $row['telephone'] . "\t" . $row['observation'] . "\t" . $row['metier'] . "\t" . $row['annees'] . "\t" . $row['nature_stage'] . "\t" . $row['service'] . "\t" . $row['reference'] . "\n";
}

// fermer la connexion à la base de données
mysqli_close($conn);