<?php
session_start();
require '../includes/db.php';
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
<!-- Bootstap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<title>AdminHub</title>

    <!-- <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

	</style> -->
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
  
	
  <?php include('message.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Modifier stagiaire
                    <a href="liste_stags.php" class="btn btn-danger float-end">BACK</a>
                </h4>
            </div>
          


            <div class="card-body">
            <?php
                        if(isset($_GET['matricule']))
                        {
                            $stag_matricule = mysqli_real_escape_string($conn, $_GET['matricule']);
                            $query = "SELECT * FROM `2023` WHERE matricule='$stag_matricule' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $stag = mysqli_fetch_array($query_run);
                                ?>
  <!-- <section id="content">
<nav> -->
<form method="POST" action="code.php">
  <div class="mb-3">
    <label for="matricule" class="form-label">Matricule</label>
    <input type="text" class="form-control" name="matricule" id="matricule" value="<?= $stag['matricule']; ?>">
  </div>

 <div class="mb-3">
    <label for="cin" class="form-label">CIN</label>
    <input type="text" class="form-control" name="cin" id="cin" value="<?= $stag['cin']; ?>">
  </div>



 <div class="mb-3">
    <label for="nom_prenom" class="form-label">Nom </label>
    <input type="text" class="form-control" name="nom" id="nom_prenom"   value="<?= $stag['nom']; ?>">
  </div>
  <div class="mb-3">
    <label for="nom_prenom" class="form-label">Prénom </label>
    <input type="text" class="form-control" name="prenom" id="prenom"   value="<?= $stag['prenom']; ?>">
  </div>

  <div class="mb-3">
  <label for="sexe" class="form-label">Sexe</label>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="sexe" id="homme" value="homme" value="<?= $stag['sexe']; ?>">M
    <!-- <label class="form-check-label" for="homme">M</label> -->
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="sexe" id="femme" value="femme" value="<?= $stag['sexe']; ?>">F <br> <br>
    <!-- <label class="form-check-label" for="femme">F</label> -->
  </div> 




<!-- 
<div class="row"> -->
              <div class="mb-3">
    <label for="date_debut" class="form-label">Date début de stage</label>
    <input type="date" class="form-control" name="date_debut" id="date_debut" value="<?= $stag['date_debut']; ?>">
  </div>

<div class="mb-3">
    <label for="date_fin" class="form-label">Date fin de stage</label>
    <input type="date" class="form-control" name="date_fin" id="date_fin"  value="<?= $stag['date_fin']; ?>">
  </div>
</div>


<div class="mb-3">
    <label for="date_naissance" class="form-label">Date de naissance</label>
    <input type="date" class="form-control" name="date_naissance" id="date_naissance" value="<?= $stag['date_naissance']; ?>">
  </div>

<div class="mb-3">
    <label for="niveau_etude" class="form-label">Niveau d'étude</label>
    <input type="text" class="form-control" name="niveau_etude" id="niveau_etude" value="<?= $stag['niveau_etude'];?>">
</div>
<div class="col-md-6">
    <label  class="form-label">institut</label>
    <input type="text" class="form-control" name="institut" id="institut" value="<?= $stag['institut'];?>">
</div> 
<div class="col-md-6">
    <label class="form-label">ville</label>
    <input type="text" class="form-control" name="ville" value="<?= $stag['ville'];?>">
</div>
<div class="col-md-6">
    <label  class="form-label">tuteur</label>
    <input type="text" class="form-control" name="tuteur" id="tuteur" value="<?= $stag['tuteur'];?>">
</div>
<div class="col-md-6">
    <label class="form-label">recommander </label>
    <input type="text" class="form-control" name="recommander" id="recommander"  value="<?= $stag['recommander'];?>">
</div>
<div class="col-md-6">
    <label  class="form-label">telephone</label>
    <input type="tel" class="form-control" name="telephone" id="telephone"  value="<?= $stag['telephone'];?>">
</div>

<div class="col-md-6">
    <label  class="form-label">observation</label>
    <input type="text" class="form-control" name="observation" id="observation"  value="<?= $stag['observation'];?>">
</div>

<div class="col-12" style="margin-top:30px;">
    <button type="submit" class="btn btn-primary" name="update">
        <i class="fas fa-edit"></i> Modifier
    </button>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-times"></i> Annuler
    </a>
</div>

</form> 
<?php
}
                            else
                            {
                                echo "<h4>No Such matricule Found</h4>";
                            }
                        }
                        ?>
</div>
		
		</section>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../js/script.js"></script>
	
</body>
</html>