<?php
require '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupération des informations du stagiaire depuis la table "stagiaires"
    $sql_stagiaire = "SELECT * FROM `2023` WHERE id = '$id'";
    $result_stagiaire = mysqli_query($conn, $sql_stagiaire);

    if (mysqli_num_rows($result_stagiaire) == 1) {
        $stag = mysqli_fetch_assoc($result_stagiaire);
    } else {
        echo "Aucun stagiaire trouvé avec l'ID $id";
    }
} else {
    echo "ID du stagiaire non spécifié dans la requête GET";
}
$date = date('Y-m-d');

// reference 
$sql = "SELECT MAX(reference) AS last_reference FROM `2023`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$last_reference = $row['last_reference'];

// Utiliser la fonction pour obtenir la nouvelle référence
$new_reference = $last_reference + 1;

$id = 1; 
// Remplacez ceci par l'ID de la ligne à mettre à jour
$sql2 = "UPDATE `2023` SET `reference` = (SELECT MAX(`reference`) + 1 FROM `2023`) WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt, 'i', $id);
if (mysqli_stmt_execute($stmt)) {
//   echo "La référence a été mise à jour avec succès.";
} else {
//   echo "Erreur lors de la mise à jour de la référence: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p style="text-align: right; margin-right: 50px;font-size: large; font-weight: bold;">Marrakech Le : <span><?php echo $date ?></span></p>
    <br>
    <h5 style="font-size: large;"><ins><span>N/REF/</span><span><?php echo $date ?></span> - <span><?= $new_reference ?></span></ins></h5>
    <br>
    <h3 style="text-align: center;font-weight: bold;border: 1px;background-color: gainsboro;padding: 10px; width: 500px; margin: auto; font-size: x-large;">ATTESTATION DE STAGE </h3>
    <br>
    <br>
    <p>Nous soussignés,<span style="font-weight: bold;"> MENARA PREFA S.A. KM 0.50 ROUTE D'AGADIR B.P. 4741 HAY <br> MASSIRA 40 0005 MARRAKECH</span></p>
    <br>
    <p>Attestons par la présente que <span style="font-weight: bold;"><?=$stag['tuteur']?> </span> titulaire de la Carte d’Identité <br> Nationale N° <span style="font-weight: bold;"><?=$stag['cin']?></span> a accompli un stage dans notre société au sein du service Contrôle interne <br> pendant le période Du <span style="font-weight: bold;"><?=$stag['date_debut']?></span> Au <span style="font-weight: bold;"><?=$stag['date_fin']?></span>.</p>
    <br><br><br><br>
    <p> En foi de quoi la présente attestation est délivrée à l’intéressée pour servir et valoir ce que de droit.</p>
    <br><br><br><br><br><br><br>
    <p style="text-align: right;margin-right: 50px;font-size: larger;">Direction Exécutive Capital Humain</p>
    <br><br><br><br><br><br><br><br><br><br><br>
    <p style="text-align: right; color: red;  padding: 10px; "><i style=" border: 1px solid red; width: 100px; font-weight: bolder;font-size: x-large;padding: 10px; ">Controlé</i></p>




    <script>
      window.print();
</script>
</body>
</html>