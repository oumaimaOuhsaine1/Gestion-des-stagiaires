<?php
require '../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $is_received = isset($_POST['is_received']) ? 1 : 0;

    // Vérifier si le bouton "Attestation" est cliqué
    if (isset($_POST['delete'])) {
        $query = "DELETE FROM `2023` WHERE id = $id";
        mysqli_query($conn, $query);
        header("Location: stage_expire.php");
        exit();
    } else {
        $query = "UPDATE `2023` SET is_received = $is_received WHERE id = $id";
        mysqli_query($conn, $query);
        header("Location: stage_expire.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
	<div class="container mt-4" style="padding-top:40px;">
		<?php include('message.php'); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nom</th>
									<th>Prenom</th>
									<th>Tuteur</th>
									<th>Date fin stage</th>
									<th>Attestation</th>
									<th>Rapport reçu</th>
                                    <th>Décision</th>

								</tr>
							</thead>
                            <tbody>
<?php
$query = "SELECT * FROM `2023` WHERE date_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 WEEK) ORDER BY date_fin ASC";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    foreach ($result as $stag) {
?>
    <tr>
        <td><?php echo $stag['id'] ?></td>
        <td><?php echo $stag['nom'] ?></td>
        <td><?php echo $stag['prenom'] ?></td>
        <td><?php echo $stag['tuteur'] ?></td>
        <td><?php echo $stag['date_fin'] ?></td>
        <td>
            <?php if ($stag['is_received']) { ?>
                <form method="POST" action="../fiche stage/att.php?id=<?=$stag['id'];?>"">
                    <input type="hidden" name="id" value="<?php echo $stag['id'] ?>" />
                    <button type="submit" class="btn btn-primary" name="attestation">Attestation</button>
                </form>
            <?php } ?>
        </td>
        <td>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $stag['id'] ?>" />
                <input type="checkbox" name="is_received" onchange="this.form.submit()" <?php echo $stag['is_received'] ? 'checked' : '' ?> />
            </form>
        </td>
        <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $stag['id'] ?>">
                    <button type="submit" name="delete" value="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
    </tr>
<?php
    }
}
?>
</tbody>
</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>
