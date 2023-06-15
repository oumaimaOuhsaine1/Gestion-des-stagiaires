<?php
// inclure le fichier de connexion à la base de données
require_once('../includes/db.php');

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
  <!-- Inclure les fichiers de SheetJS -->



<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>AdminHub</title>
    <style>
    .demandes {
    border: 1px solid #ccc;
    padding: 10px;
}</style>
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

</head>
<body>


	

<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>

	<section id="content">
	
<!doctype html>
<html lang="en">

<body>
<div class="modal fade" id="viewStg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        <div class="stag_view"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFermer">Fermer</button>
      </div>
    </div>
  </div>
</div>
    <div class="container mt-4" style="padding-top:40px;">

	<?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; background-color: #f8f9fa; padding: 20px;">
    <form method="POST" action="recherche.php" style="display:flex;">
        <input type="text" name="ville" placeholder="Entrez une ville" style="border: 1px solid #ced4da; padding: 10px; width: 300px; margin-right: 10px;">
        <input type="text" name="metier" placeholder="Entrez un métier" style="border: 1px solid #ced4da; padding: 10px; width: 300px; margin-right: 10px;">
        <form class="form-inline">
  <button type="submit" name="rechercher" class="btn btn-warning" style="padding: 10px 10px; font-size: 16px; font-weight: bold; color: #4D4D4D; background-color: #A39475; border-color: transparent">
    <i class="fas fa-search" style="margin-right: 5px;"></i>
  </button>
</form>

<a href="add_stag.php" class="btn btn-primary" style="padding: 10px 8px; font-size: 16px; font-weight: bold; color: #000000; background-color: #D2CBCD; border-color: transparent">
  <i class="fas fa-user-plus" style="margin-right: 5px;"></i>
</a>
<form action="export.php" method="post">

<button type="submit" name="export_excel" style="background-color: #f2f2f2; color: #333; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold; padding: 10px 20px; border-radius: 5px; border: none;"><i class="fas fa-file-excel" style="margin-right: 10px;"></i>Excel</button>

</button>

</form>


</div>

                    <div class="card-body">

                        <table class="table table-bordered table-striped" id='tableID'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Matricule</th>
                                    <th>Nom  </th>
                                    <th>Prenom</th>
                                    <th>Institut</th>
                                    <th>Ville</th>
                                    <th>Décisions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
    								$query = "SELECT * FROM `2023`";									
									$query_run = mysqli_query($conn, $query);

									if(mysqli_num_rows($query_run) > 0)
									{
										foreach($query_run as $stag)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $stag['id']; ?></td>
                                                <td class="stag_Mat"><?= $stag['matricule']; ?></td>
                                                <td><?= $stag['nom']; ?></td>
                                                <td><?= $stag['prenom']; ?></td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
  $('#btnFermer').click(function() {
    $('#viewStg').modal('hide');
  });
});
</script>


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

        
    </script>
<div id="searchResults"></div>
<script>
$(document).ready(function() {
    // Écouter l'événement d'entrée de texte dans l'input de recherche
    $("#searchInput").on("input", function() {
        // Récupérer la valeur de l'input de recherche
        var searchTerm = $(this).val();
        
        // Effectuer une requête Ajax au serveur pour récupérer les résultats de recherche
        $.ajax({
            url: "recherche.php", // Le fichier PHP pour effectuer la recherche dans la base de données
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
<script>
    function exportToExcel(tableId) {
        let table = document.getElementById(tableId);
        let fileName = "export.xlsx";
        let ws = XLSX.utils.table_to_sheet(table);
        let wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
        XLSX.writeFile(wb, fileName);
    }
</script>

</body>
</html>