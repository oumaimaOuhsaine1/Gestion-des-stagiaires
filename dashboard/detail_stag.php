<?php
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
</head>
<body>
<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>
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
    <!-- <div class="container mt-5"> -->
<section id="content">
        <div class="row">
            <div class="col-md-12" >
                <div class="card">
                    <div class="card-header">
                        <h4>Stag View Details 
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
                                
                                    <div class="mb-3">
                                        <label>matricule</label>
                                        <p class="form-control">
                                            <?=$stag['matricule'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>cin</label>
                                        <p class="form-control">
                                            <?=$stag['cin'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>nom&prenom</label>
                                        <p class="form-control">
                                            <?=$stag['nom_prenom'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label> sexe</label>
                                        <p class="form-control">
                                            <?=$stag['sexe'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>stag date debut</label>
                                        <p class="form-control">
                                            <?=$stag['date_debut'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>date fin</label>
                                        <p class="form-control">
                                            <?=$stag['date_fin'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>date de naissance</label>
                                        <p class="form-control">
                                            <?=$stag['date_naissance'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Niveau d'etude </label>
                                        <p class="form-control">
                                            <?=$stag['niveau_etude'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>institut </label>
                                        <p class="form-control">
                                            <?=$stag['institut'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>ville</label>
                                        <p class="form-control">
                                            <?=$stag['ville'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>tuteur </label>
                                        <p class="form-control">
                                            <?=$stag['tuteur'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>recommander </label>
                                        <p class="form-control">
                                            <?=$stag['recommander'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>telephone</label>
                                        <p class="form-control">
                                            <?=$stag['telephone'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>observation</label>
                                        <p class="form-control">
                                            <?=$stag['observation'];?>
                                        </p>
                                    </div>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such matricule Found</h4>";
                            }
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