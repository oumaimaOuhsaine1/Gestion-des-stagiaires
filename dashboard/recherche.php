<?php 
include_once '../includes/db.php';

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

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>AdminHub</title>
    <style>
    .demandes {
    border: 1px solid #ccc;
    padding: 10px;
}</style>

</head>
<body>
<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			
			<form action="#">
			
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			
		</nav>
	</section>
	<!-- CONTENT -->
	<section id="content">
	
<!doctype html>
<html lang="en">

<body>
<div class="modal fade" id="viewStg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="stag_view"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="container mt-4" style="padding-top:40px;">

	<?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display:flex">
                    <div style="margin-left:780px;">
       
                    </div>
                    </div>
                    <div class="card-body">
    <table class="table table-bordered table-striped">
        <thead>
    <tr>
      <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Institut</th>
            <th>Ville</th>
            <th>Décision</th>
          </tr>
        </thead>
    <tbody>
    <?php                   
 if (isset($_POST['rechercher'])) {
  // Récupérer la ville et le métier saisis par l'utilisateur
  $ville = mysqli_real_escape_string($conn, $_POST['ville']);
  $metier = mysqli_real_escape_string($conn, $_POST['metier']);
  $sql = "SELECT * FROM `2023` WHERE 1=1";

if (!empty($ville) && !empty($metier)) {
  $sql .= " AND ville = ? AND metier = ?";
  $params = array($ville, $metier);
} elseif (!empty($ville)) {
  $sql .= " AND ville = ?";
  $params = array($ville);
} elseif (!empty($metier)) {
  $sql .= " AND metier = ?";
  $params = array($metier);
} else {
  $params = array();
}

$stmt = mysqli_prepare($conn, $sql);

if (!empty($params)) {
  $types = str_repeat('s', count($params));
  mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$resultats = mysqli_stmt_get_result($stmt);

  

  // Afficher les résultats de la recherche
  if (mysqli_num_rows($resultats) > 0) {
      // Afficher chaque enregistrement trouvé
      while ($row = mysqli_fetch_assoc($resultats)) {
          // Traiter chaque enregistrement trouvé ici
      }
  } else {
  }

                        

  // Afficher les résultats
  if (mysqli_num_rows($resultats) > 0) {
    foreach($resultats as $stag){
      ?>
          <tr>
          <td class="stag_Mat"><?= $stag['matricule']; ?></td>
          <td><?= $stag['nom']; ?></td>
          <td><?= $stag['prenom']; ?></td>
          <td><?= $stag['date_naissance']; ?></td>
          <td><?= $stag['institut']; ?></td>
          <td><?= $stag['ville']; ?></td>

          <td>
          <a href="#" class="btn btn-primary btn-sm view_btn"><i class="fas fa-eye"></i></a>
  <a href="edit_stag.php?matricule=<?= $stag['matricule']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
  <form action="code.php" method="POST" class="d-inline">
    <button type="submit" name="delete" value="<?=$stag['matricule'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
  </form>
  <a href="../fiche stage/fiche.php?id=<?=$stag['id'];?>" class="btn btn-warning btn-sm" name="imprimer"><i class="fas fa-print"></i></a>
</td>

                                            </tr>
      <?php 
  } }else {
      // Afficher un message si aucun résultat n'a été trouvé
      echo "<tr><td colspan='7'>Aucun résultat trouvé.</td></tr>";
  } }


?>

</tbody>
</table>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 

</body>
</html>
		
		</section>
	

	<script src="../js/script.js"></script>
	
        <script>
      
      $(document).ready(function(){
  $('.view_btn').click(function(){
    var stag_Mat = $(this).closest('tr').find('.stag_Mat').text();
    $.ajax({
      type:"POST",
      url:"code.php",
      data:{
        'check_viewbtn':true,
        'stag_Mat':stag_Mat,
      },
      success: function(response){
        $('.stag_view').html(response);
        $('#viewStg').modal('show');
      }
    })
  });
});


function showPhoto(id) {
  var image_path = $('button[data-image][onclick*="showPhoto('+id+')"]').data('image');
  window.open(image_path);
}

function showCV(id) {
  var cv_path = $('button[data-cv][onclick*="showCV('+id+')"]').data('cv');
  window.open(cv_path);
}


        
    </script>
<!-- <div id="searchResults"></div>
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
}); -->
</script>

