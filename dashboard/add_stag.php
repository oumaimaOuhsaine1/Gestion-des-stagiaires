


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
	<title>Admin  </title>

  <style>
    .container {
    margin-left: 30px;
}



.form-control {
    border: 1px solid black;
    color: #333;
}

.btn-primary {
    background-color: #D2B48C;
    border-color: #D2B48C;
    color: #333;
    margin-left:330px;
    width:150px;
    height:50px;
}

.btn-primary:hover {
    background-color: #;
    border-color: #e5e5e5;
    color: #333;
}

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
		<main>
			<div class="head-title">
				<div class="left">
					<h1 style='font-family:dax;'>Ajouter un stagiaire</h1>
				
				</div>
				
			</div>

			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<section id="content">
    <!-- <div class="container mt-5"> -->


<div class="row">
<?php include('message.php'); ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    <a href="liste_stags.php" class="btn btn-danger float-end" style="background-color:#8B7355; border-color:#8B7355;">Retour</a>
                </h4>
            </div>
            <br>
            <div class="card-body">
            <form method="POST" action="code.php" enctype="multipart/form-data">
    <div style='margin-left:30px;'>
  <div class="row mb-3">
  <div class="col">
    <label for="matricule" class="form-label">Matricule</label>
    <input type="text" class="form-control" name="matricule" id="matricule" placeholder="Matricule" required>
  </div>

  <div class="col-md-6">
    <label for="cin" class="form-label">CIN</label>
    <input type="text" class="form-control" name="cin" id="cin" placeholder="CIN" required>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="nom" class="form-label">Nom </label>
    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom " required>
  </div>
  <div class="col-md-6">
    <label for="prenom" class="form-label">Prénom</label>
    <input type="text" class="form-control" name="prenom" id="prenom" placeholder=" Prénom" required>
  </div>
</div>

<div class="col-md-6" style="display:flex;">
  
  <div class="form-check" style="margin-left:20%;">
       <input class="form-check-input" type="radio" name="sexe" value="H" id="sexe1" checked>
        <label class="form-check-label" for="sexe1">
              Homme
          </label>
      </div>
      
      <div class="form-check" style="margin-left:60%;">
          <input class="form-check-input" type="radio" name="sexe" value="F" id="sexe2" >
          <label class="form-check-label" for="sexe2">
              Femme
          </label>
      </div>
</div>

<br>

<div class="row">
  <div class="col-md-6">
    <label for="date_debut" class="form-label">Date début de stage</label>
    <input type="date" class="form-control" name="date_debut" id="date_debut" placeholder="Date début de stage" required>
  </div>

  <div class="col-md-6">
    <label for="date_fin" class="form-label">Date fin de stage</label>
    <input type="date" class="form-control" name="date_fin" id="date_fin" placeholder="Date fin de stage" required>
  </div>
</div>
<br>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="date_naissance" class="form-label">Date de naissance</label>
    <input type="date" class="form-control" name="date_naissance" id="date_naissance" placeholder="Date de naissance" required>
  </div>

  <div class="col-md-6">
    <label for="niveau_etude" class="form-label">Niveau d'étude</label>
    <input type="text" class="form-control" name="niveau_etude" id="niveau_etude" placeholder="Niveau d'étude" required>
  </div>
</div>
<br>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="institut" class="form-label">Institut :</label>
    <input type="text" class="form-control" id="institut" name="institut">
  </div>
  <div class="col-md-6">
  <label for="ville" class="form-label">Ville :</label>
<input type="text" class="form-control" id="ville" name="ville">
  </div>
</div>
<br>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="tuteur" class="form-label">Tuteur :</label>
    <input type="text" class="form-control" id="tuteur" name="tuteur">
  </div>
  <div class="col-md-6">
    <label for="recommander" class="form-label">Recommandé par :</label>
    <input type="text" class="form-control" id="recommander" name="recommander">
  </div>
</div>
<br>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="telephone" class="form-label">Numéro de téléphone :</label>
    <input type="tel" class="form-control" id="telephone" name="telephone">
  </div>
  <div class="col-md-6">
    <label for="observation" class="form-label">Observation :</label>
    <textarea class="form-control" id="observation" name="observation"></textarea>
  </div>
</div>
<br>
<div class="row mb-3">
<div class="col-md-6">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="col-md-6">
    <label for="metier" class="form-label">metier :</label>
    <input type='text' class="form-control" id="metier" name="metier">
  </div>
</div>
<br>
<div class="row mb-3">
<div class="col-md-6">
    <label for="nature" class="form-label">nature de stage:</label>
    <input type="text" class="form-control" id="nature" name="nature">
  </div>
  <div class="col-md-6">
    <label for="service" class="form-label">service :</label>
    <input type="text" class="form-control" id="service" name="service">
  </div>
</div>
<br>
<div class="row mb-3">
<div class="col-md-6">
    <label for="cv" class="form-label">CV:</label>
    <input type="file" class="form-control" id="cv" name="cv">
  </div>
  <div class="col-md-6">
    <label for="photo" class="form-label">photo :</label>
    <input type='file' class="form-control" id="photo" name="photo">
  </div>
</div>
<br>
  <div class="col-md-12">
    <button type="submit" class="btn btn-primary" name="save">
    <i class="fas fa-save"></i>Enregistrer</button>
  </div>
</div>
</form>
</div>
		<nav>
			</nav>
		</section>
	

	<script src="../js/script.js"></script>
	
</body>
</html>