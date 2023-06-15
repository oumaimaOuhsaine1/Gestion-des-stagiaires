<?php
    session_start();
    require '../includes/db.php';
    // include '../include/Session.php';

    // Récupération de l'ID du stagiaire à refuser depuis la requête GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // Récupération des informations du stagiaire depuis la table des demandes
        $sql_select_demande = "SELECT * FROM cvs WHERE id = '$id'";
        $result_select_demande = mysqli_query($conn, $sql_select_demande);
    
        if ($result_select_demande && mysqli_num_rows($result_select_demande) > 0) {
            $demande = mysqli_fetch_assoc($result_select_demande);
            $id = $demande['id'];
            $cin = $demande['cin'];
            $nom = $demande['nom'];
            $prenom = $demande['prenom'];
            $age = $demande['age'];
            $ville = $demande['ville'];
            $date_naissance = $demande['date_naissance'];
            $date_debut = $demande['date_debut'];
            $date_fin = $demande['date_fin'];
            $email = $demande['email'];
            $gender = $demande['gender'];
            $tele = $demande['telephone'];
            $metier = $demande['metier'];
            $annees = $demande['annees'];
            $exp = $demande['experience'];
            $picture = $demande['picture'];
            $cv = $demande['file_pdf'];

         // Insertion du stagiaire dans la table des demandes refusées avec toutes les informations
            $sql_insert_demande_refus = "INSERT INTO `demande_refus`(`id`, `cin`, `picture`, `gender`, `prenom`, `nom`, `email`, `telephone`, `ville`, `date_naissance`, `date_debut`, `date_fin`, `metier`, `annees`, `file_pdf`, `experience`) VALUES ('$id','$cin','$picture','$gender','$nom', '$prenom', '$age', '$ville','$date_naissance','$date_debut','$date_fin','$email','$tele','$metier','$annees','$exp','$cv')";
            $result_insert_demande_refus = mysqli_query($conn, $sql_insert_demande_refus);
    
            // Suppression du stagiaire de la table des CVs
            $sql_delete_cv = "DELETE FROM cvs WHERE id = '$id'";
            $result_delete_cv = mysqli_query($conn, $sql_delete_cv);
    
           
    
            if ($result_insert_demande_refus && $result_delete_cv) {
                // Redirection vers la page demande_refus.php
                echo 'Stagiare Refuser';
                header("Location: demande_refus.php");
                exit;
            } else {
                // Gestion de l'erreur
                echo "Erreur lors de la suppression du stagiaire ou de l'insertion dans la table demande_refus : " . mysqli_error($conn);
            }
        } else {
            // Gestion de l'erreur si la demande n'a pas été trouvée
            echo "Erreur : Demande introuvable dans la table demandes.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
	<title>AdminHub</title>
    <style>
        <style>
  table {
    font-family: 'Dax Light', sans-serif;
    font-size: 16px;
  }
  th {
    font-size: 20px;
    font-weight: bold;
  }
  td {
    font-size: 16px;
  }
</style>
    </style>
</head>
<body>


	

<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		
		<!-- NAVBAR -->

		<!-- MAIN -->
		<!-- <main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

			
		</main> -->
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<section id="content">
	
<!doctype html>
<html lang="en">

<body>
    <!-- model View -->
   <div class="modal fade" id="viewCv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" href="demande.php">
          <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        <div class="cv_view"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFermer">Fermer</button>      </div>
    </div>
  </div>
</div>

    <div class="container mt-4"  style="padding-top:40px;">

	<?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>
                            <a href="add_stag.php" class="btn btn-primary float-end">Ajout de stag</a>
                        </h4>
                    </div> -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Nom</th>
                                    <th>prenom</th>
                                    <th>Ville</th>
                                    <th>Décisions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM `cvs`";									
									$query_run = mysqli_query($conn, $query);

									if(mysqli_num_rows($query_run) > 0)
									{
										foreach($query_run as $stag)
                                        {
                                             ?>
                                                <tr>
                                                <td class="cv_id"><?= $stag['id'];?></td>
                                                <td><?= $stag['email']; ?></td>
                                                <!-- <td><?= $stag['picture'];?></td> -->
                                                <!-- <td><?= $stag['file_pdf'];?></td> -->
                                                <td><?= $stag['nom']; ?></td>
                                                <td><?= $stag['prenom']; ?></td>
                                                
                                                <td><?= $stag['ville'];?></td>
                                                <!-- <td><?= $stag['niveau']; ?></td> -->
                                               
                                                <td>
  <a  class="btn btn-info btn-sm view_btn" style="background-color: #007bff; border-color: #007bff;">
    <i class="fas fa-eye" style="color: #fff;"></i>
  </a>
  <a href="demande_accep.php?id=<?= $stag['id']; ?>" class="btn btn-success" name="accepter" style="background-color: #28a745; border-color: #28a745;">
    <i class="fas fa-check" style="color: #fff;"></i>
  </a>
  <a href="demande_refus.php?id=<?= $stag['id']; ?>" class="btn btn-danger" style="background-color: #dc3545; border-color: #dc3545;">
    <i class="fas fa-times" style="color: #fff;"></i>
  </a>
</td>




                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
  $('.view_btn').click(function() {
    var cv_id = $(this).closest('tr').find('.cv_id').text();
    $.ajax({
      type: "POST",
      url: "code.php",
      data: {
        'check_Cvbtn': true,
        'cv_id': cv_id,
      },
      success: function(response) {
        $('.cv_view').html(response);
        $('#viewCv').modal('show');
      }
    });
  });
})

function showPhoto(id) {
  var image_path = $('button[data-image][onclick*="showPhoto('+id+')"]').data('image');
  window.open(image_path);
}

function showCV(id) {
  var cv_path = $('button[data-cv][onclick*="showCV('+id+')"]').data('cv');
  window.open(cv_path);
}


</script>
<script>
$(document).ready(function() {
  $('#btnFermer').click(function() {
    $('#viewStg').modal('hide');
  });
});
</script>
    <script>
<div id="searchResults"></div>
<script>
$(document).ready(function() {
    // Écouter l'événement d'entrée de texte dans l'input de recherche
    $("#searchInput").on("input", function() {
        // Récupérer la valeur de l'input de recherche
        var searchTerm = $(this).val();
        
        // Effectuer une requête Ajax au serveur pour récupérer les résultats de recherche
        $.ajax({
            url: "rechercher_stagiaires.php", // Le fichier PHP pour effectuer la recherche dans la base de données
            method: "POST",
            data: { searchTerm: searchTerm }, // Les données à envoyer au serveur
            success: function(data) {
                // Afficher les résultats de recherche dans la div dédiée
                $("#searchResults").html(data);
            }
        });
    });
});
</script>

    </script>
</body>
</html>
		
		</section>
	

	<script src="../js/script.js"></script>
	<style>

	</style>
</body>
</html>