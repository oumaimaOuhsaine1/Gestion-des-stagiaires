
<?php
session_start();
require '../includes/db.php';



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_select = "SELECT * FROM `cvs` WHERE id = $id";
    $result_select = mysqli_query($conn, $query_select);

    if (mysqli_num_rows($result_select) > 0) {
        $stagiaire = mysqli_fetch_assoc($result_select);
        $query_insert = "INSERT INTO demande_refus(cin, date_naissance, date_debut, date_fin, picture, gender, prenom, nom, email, telephone, ville, intitule, metier, annees, niveau, statuts_publication, file_pdf, lettre_motivation, niveau_poste, secteur_activite) 
        VALUES ('".$stagiaire['cin']."', '".$stagiaire['date_naissance']."', '".$stagiaire['date_debut']."', '".$stagiaire['date_fin']."', '".$stagiaire['picture']."', '".$stagiaire['gender']."', '".$stagiaire['prenom']."', '".$stagiaire['nom']."', '".$stagiaire['email']."', '".$stagiaire['telephone']."', '".$stagiaire['ville']."', '".$stagiaire['intitule']."', '".$stagiaire['metier']."', '".$stagiaire['annees']."', '".$stagiaire['niveau']."', 'refuse', '".$stagiaire['file_pdf']."', '".$stagiaire['lettre_motivation']."', '".$stagiaire['niveau_poste']."', '".$stagiaire['secteur_activite']."')";

        mysqli_query($conn, $query_insert);

        $query_delete = "DELETE FROM `cvs` WHERE id = $id";
        mysqli_query($conn, $query_delete);

        header('Location: demande_refus.php');
        exit();
    } else {
        echo "<h5> Aucun enregistrement trouvé </h5>";
    }
} else {
    echo "L'ID n'est pas défini.";
}
if (isset($_POST['supprimer_tout'])) {
    $query_delete_all = "DELETE FROM `demande_refus`";
    mysqli_query($conn, $query_delete_all);

    header('Location: demande_refus.php');
    exit();
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Stag View</title>
    <style>
  table {
    font-family: 'Dax Light', sans-serif;
    font-size: 16px;
    /* border:1px solid grey; */
  }
  th {
    font-size: 20px;
    font-weight: bold;
    border: 0.5px solid #ccc;  }
  td {
    font-size: 16px;
    border: 0.5px solid #ccc;  }
</style>
</head>
<body>
<?php include('../includes/sidebar.php') ?>

<section id="content">
<div class="container mt-4" style="padding-top:40px;">

<?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <a href="demande.php" class="btn btn-danger float-end" style="background-color: #D2B48C; color: white; border:1px solid #D2B48C ">RETOUR</a>
                        </h4>
                        <form action="" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les enregistrements ?');">
  <button type="submit" name="supprimer_tout" class="btn" style="background-color: #8B0000; color: #fff;">
    <i class="fas fa-trash"></i> Supprimer tout
  </button>
</form>



                    </div>
                    <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>                           
                            <th>Métier</th>
                            <th>Niveau d'études</th>
                            <th>Décision</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
    								$query = "SELECT * FROM `demande_refus`";									
									$query_run = mysqli_query($conn, $query);

									if(mysqli_num_rows($query_run) > 0)
									{
										foreach($query_run as $stag)
                                        {
                                            ?>
                                            <tr>
                                            <td class="cv_id"><?= $stag['id']; ?></td>
                                                <td><?= $stag['nom']; ?></td>
                                                <td><?= $stag['prenom']; ?></td>
                                                <td><?= $stag['metier']; ?></td>
                                                <td><?= $stag['niveau']; ?></td>
                                               
                                                <td> 
                                                <form action="code.php" method="POST" class="d-inline">
  <input type="hidden" name="stag_id" value="<?=$stag['id'];?>" /> <!-- Ajout d'un input caché pour l'ID -->
  <button type="submit" name="supprimer" class="btn btn-danger btn-sm">
  <i class="fas fa-trash-alt"></i>
</button>
</form>

                                                </td>
                                               </tr>
                                                
                                             


                                              
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Aucun enregistrement trouvé.</h5>";
                                    }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>


  </body>
</html>