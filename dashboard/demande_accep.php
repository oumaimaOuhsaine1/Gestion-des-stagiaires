<?php
require '../includes/db.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM `cvs` WHERE `id` = '$id'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) > 0) {
        $stag = mysqli_fetch_array($query_run);

        if(isset($_POST['accepter'])) {
            $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
            $id = mysqli_real_escape_string($conn, $stag['id']);
            $cin = mysqli_real_escape_string($conn, $stag['cin']);
            $sexe = mysqli_real_escape_string($conn, $stag['gender']);
            $picture = mysqli_real_escape_string($conn, $stag['picture']);
            $nom = mysqli_real_escape_string($conn, $stag['nom']);
            $prenom = mysqli_real_escape_string($conn, $stag['prenom']);
            $recommender = mysqli_real_escape_string($conn, $_POST['recommender']);
            $date_naissance = mysqli_real_escape_string($conn, $stag['date_naissance']);
            $email = mysqli_real_escape_string($conn, $stag['email']);
            $telephone = mysqli_real_escape_string($conn, $stag['telephone']);
            $ville = mysqli_real_escape_string($conn, $stag['ville']);
            $ecole = mysqli_real_escape_string($conn, $stag['intitule']);
            $metier = mysqli_real_escape_string($conn, $stag['metier']);
            $annees = mysqli_real_escape_string($conn, $stag['annees']);
            $niveau = mysqli_real_escape_string($conn, $stag['niveau']);
            $date_debut = mysqli_real_escape_string($conn, $stag['date_debut']);
            $date_fin = mysqli_real_escape_string($conn, $stag['date_fin']);
            $file = mysqli_real_escape_string($conn, $stag['file_pdf']);
            $nature = mysqli_real_escape_string($conn, $_POST['nature']);
            $tuteur = mysqli_real_escape_string($conn, $_POST['tuteur']);
            $service = mysqli_real_escape_string($conn, $_POST['service']);
            
            $insert_query = "INSERT INTO `2023`(`id`, `matricule`, `cin`, `nom`, `prenom`, `sexe`, `date_debut`, `date_fin`, `date_naissance`, `niveau_etude`, `institut`, `ville`, `email`, `tuteur`, `recommander`, `telephone`, `observation`, `metier`, `annees`, `nature_stage`, `service`, `photo`, `cv`) VALUES
            ('$id', '$matricule','$cin','$nom','$prenom','$sexe','$date_debut','$date_fin','$date_naissance','$niveau','$ecole','$ville','$email','$tuteur','$recommender','$telephone','Bien','$metier','$annees','$nature','$service', '$picture','$file')";
            $insert_query_run = mysqli_query($conn, $insert_query);

            if($insert_query_run) {
                // Succès de l'insertion
                $query_delete = "DELETE FROM `cvs` WHERE id = $id";
                 mysqli_query($conn, $query_delete);
                // echo "Les données ont été insérées avec succès dans la table '2023' !";
                header('Location: liste_stags.php');
                exit();
            } else {
                // Erreur lors de l'insertion
                echo "Erreur : les données n'ont pas pu être insérées dans la table '2023'...";
            }
        }
    }
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
    .marron-degrade {
        
    background-color: #D2B48C;
    border-color: #D2B48C;
    color: #333;
    margin-left:330px;
    width:150px;
    height:50px;

    }
</style>


</head>
<body>
<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>
<section id="content">
		<!-- NAVBAR -->
		
	</section>
    <!-- <div class="container mt-5"> -->
<section id="content">
        <div class="row">
        <h3 style="font-family:dax; text-align:center; margin-top:40px; margin-bottom:40px;"> Les Demandes Acceptées</h3>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                        <a href="demande.php" class="btn btn-danger float-end" style="background-color:#8B7355; border-color:#8B7355;">Retour</a>
                        </h4>
	                    <?php include('message.php'); ?>

                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id'])) {

                            $id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM `cvs` WHERE `id` = '$id'";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $stag = mysqli_fetch_array($query_run);
                                ?>  
                                <form  method="post" >
                                    <div class="mb-3">
                                        <label>Matricule</label>
                                        <input type="text" class="form-control" name="matricule">
                                    </div>
                                    <div class="mb-3">
                                        <label>id</label>
                                        <p class="form-control">
                                            <?=$stag['id'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Cin</label>
                                        <p class="form-control">
                                            <?=$stag['cin'];?>
                                        </p>
                                        <!-- <input type="text" class="form-control" name="cin"> -->
                                    </div>
                                    <div class="mb-3">
                                        <label>picture</label>
                                        <p class="form-control">
                                        <a href="<?=$stag['picture'];?>" target="_blank">Photo Stagiaire</a>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Sexe</label>
                                        <p class="form-control">
                                            <?=$stag['gender'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Prenom</label>
                                        <p class="form-control">
                                            <?=$stag['prenom'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Nom</label>
                                        <p class="form-control">
                                            <?=$stag['nom'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date Naissance</label>
                                        <p class="form-control">
                                            <?=$stag['date_naissance'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <p class="form-control">
                                            <?=$stag['email'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Téléphone</label>
                                        <p class="form-control">
                                            <?=$stag['telephone'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Ville </label>
                                        <p class="form-control">
                                            <?=$stag['ville'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Institut </label>
                                        <p class="form-control">
                                            <?=$stag['intitule'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Métier</label>
                                        <p class="form-control">
                                            <?=$stag['metier'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Année</label>
                                        <p class="form-control">
                                            <?=$stag['annees'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Niveau</label>
                                        <p class="form-control">
                                            <?=$stag['niveau'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nature Stage</label>
                                        <input type="text" class="form-control" name="nature">
                                    </div>
                                    <div class="mb-3">
                                        <label>Tuteur</label>
                                        <input type="text" class="form-control" name="tuteur">
                                    </div>
                                    <div class="mb-3">
                                        <label>Service/Direction</label>
                                        <input type="text" class="form-control" name="service">
                                    </div>
                                    <div class="mb-3">
                                        <label>Recommender</label>
                                        <input type="text" class="form-control" name="recommender">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date debut Stage</label>
                                        <!-- <input type="date" class="form-control" name="date_debut"> -->
                                        <p class="form-control">
                                            <?=$stag['date_debut'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date Fin Stage</label>
                                        <!-- <input type="date" class="form-control" name="date_fin"> -->

                                        <p class="form-control">
                                            <?=$stag['date_fin'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>CV</label>
                                        <p class="form-control">
                                            <a href="<?=$stag['file_pdf'];?>" target="_blank">CV file </a> 
                                        </p>
                                    </div>
                                    <!-- target="_blank" -->
                                    <div class="mb-3">
                                        <label></label>
                                        <input type="submit" class="btn btn-success btn-md marron-degrade" name="accepter" value="Accepter">
</div>
                                    <!-- <div class="mb-3">
                                        <label></label>
                                        <input type="submit" class="btn btn-info btn-sm" >
                                        <a href="../fiche stage/fiche.php?id=<?=$stag['id']?>" class="btn btn-primary btn-md" name="imprimer">Imprimer</a>
                                    </div> -->
                                    </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such matricule Found</h4>";
                            }
                        }
                    else
                    {
                        echo "Error: " . mysqli_error($conn);
                    }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>