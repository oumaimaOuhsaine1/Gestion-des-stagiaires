<?php
// Connexion à la base de données
require '../includes/db.php';


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
.form-inline {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  width: 100%;
  /* max-width: 800px; */
  padding: 20px;
  box-sizing: border-box;
}
body{
  width:100%;
    height:100vh;
    background-color: #f2f2f2;

    background-position: center;
    background-size:cover;
    position:relative;
}

.form-inline label {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

.form-inline div {
  margin-right: 20px;
}

.form-inline input[type="text"],
.form-inline input[type="date"] {
  flex: 1;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px;
  font-size: 16px;
  height: 30px !important;
  width: 100% !important;
}



.form-inline button[type="submit"] {
  border: none;
  background-color: #007bff;
  color: #fff;
  padding: 8px 20px;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  margin-left: 10px;
}

.form-inline button[type="submit"]:hover {
  background-color: #0069d9;
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

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>État de pointage</h1>
                    <ul class="breadcrumb">
                 <!-- FORMULAIRE DE FILTRAGE -->
                 <form method="post" action="" class="my-3 form-inline d-flex justify-content-center align-items-center">
  <label for="matricule" class="mx-3">Matricule :</label>
  <input type="text" name="matricule" id="matricule" value="<?php echo isset($_POST['matricule']) ? $_POST['matricule'] : ''; ?>" class="form-control mx-3 border border-secondary">
  <div class="mx-3"></div>
  <label for="date" class="mx-3">Date:</label>
  <input type="date" name="date" id="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>" required class="form-control mx-3">
  
  <button type="submit" name="present" class="btn btn-success mx-3" style="background-color: #2E8B57; border-color: #D2CBCD;">
  <i class="fa fa-check-circle mr-1"></i> Présent
</button>

<button type="submit" name="absent" class="btn btn-danger mx-3" style="background-color:#D9534F; border-color:#D2CBCD;">
  <i class="fa fa-times-circle mr-1"></i> Absent
</button>



</form>







<!-- TABLEAU -->
<table class="table table-bordered table-striped my-3">
  <thead>
    <tr>
      <th>Matricule</th>
      <th>Date de présence</th>
      <th>Heure d'entrée</th>
      <th>Heure de sortie</th>
      <th>Statut</th> <!-- Nouvelle colonne -->
    </tr>
  </thead>
  <tbody>
  <?php
    // Récupérer les valeurs du formulaire
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : '';
    
    // Construire la requête SQL en fonction des valeurs du formulaire
    $sql = "SELECT matricule, date_presence, heure_entree, heure_sortie, IF(heure_sortie = '00:00:00', 'Absent', 'Présent') as statut FROM pointage_stagiaire";
    if ($date != '') {
      $sql .= " WHERE date_presence = '$date'";
    }
    if ($matricule != '') {
      $sql .= ($date != '') ? " AND matricule = '$matricule'" : " WHERE matricule = '$matricule'";
    }
    if (isset($_POST['present'])) {
      $sql .= " AND heure_sortie != '00:00:00'";
    }
    if (isset($_POST['absent'])) {
      $sql .= " AND heure_sortie = '00:00:00'";
    }
    
    $result = mysqli_query($conn, $sql);
    
    // Afficher les informations de pointage des stagiaires
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>'.$row['matricule'].'</td>';
          echo '<td>'.$row['date_presence'].'</td>';
          echo '<td>'.$row['heure_entree'].'</td>';
          echo '<td>'.$row['heure_sortie'].'</td>';
          echo '<td>';
          if ($row['statut'] == 'Absent') {
              echo '<i class="fa fa-times text-danger"></i> Absent';
          } else {
              echo '<i class="fa fa-check text-success"></i> Présent';
          }
          echo '</td>';
          echo '</tr>';
      }
  } else {
      echo '<tr><td colspan="5">Aucun enregistrement trouvé.</td></tr>';
  }
  ?>
  </tbody>
</table>
</section>

<!-- My JS -->
<script src="../js/script.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>