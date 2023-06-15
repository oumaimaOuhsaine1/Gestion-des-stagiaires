<?php
session_start();
require_once('../includes/db.php');

// Récupérer l'identifiant de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Afficher les informations de l'utilisateur
    $user = mysqli_fetch_assoc($result);
    if ($user['gender'] == 'M') {
        $profile_title = 'MONSIEUR ' . $user['nom'] . ' ' . $user['prenom'];
    } else {
        $profile_title = 'MADAME ' . $user['nom'] . ' ' . $user['prenom'];
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profil - Mon Site Web</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    	.contaner {
   width:120%;
   padding-left: 400px;
   padding-top: 50px;
   background-color: #f2f2f2;
   height: 600px;
   padding: 70px 400px;
}
h1 {
  font-family: 'Dax Light', sans-serif;
  font-size: 36px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #171717;
  margin-bottom: 20px;
  border-bottom: 3px solid #A39475;
  padding-bottom: 10px;
}
table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}
		table td, table th {
			padding: 10px;
			border: 1px solid #888;
			color: #6c757d;
		}
        table td{
			background-color: #D8D8D8;
			font-family: 'Dax Light', sans-serif;
		font-size: 16px;
        }
		table th {
			background-color: #f8f9fa;
			font-weight: bold;
			text-align: left;
			font-family: 'Dax Medium', sans-serif;
		font-size: 20px;
		}
        td.hidden {
    display: none;
}
.btn {
  display: inline-block;
  padding: 8px 16px;
  font-size: 16px;
  border: 2px solid;
  border-radius: 4px;
  text-decoration: none;
  margin: 8px;
  text-align: center;
}

.btn-edit {
  color: #ffffff;
  background-color: #A39475;
  border-color: #A39475;
}

.btn-register {
  color: #000000;
  background-color: #D2CBCD;
  border-color: #D2CBCD;
  /* top: 20px; */
  left:1000px;
  position: absolute;
}

.btn-logout {
  color: #ffffff;
  background-color: #C4BCB4;
  border-color: #C4BCB4;
}
</style>
</head>
<body>
<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>

<div class="contaner">
    <h1 style='text-align:center;'><?php echo $profile_title; ?></h1> <br> <br> 
    <table>
        <tr>
            <td class="hidden"><?php echo $user['id']; ?></td>
        </tr>
        <tr>
            <th>Nom complet </th>
            <td><?php echo $user['nom'] . ' ' . $user['prenom']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $user['email']; ?></td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td><?php echo $user['telephone']; ?></td>
        </tr>
    </table> <br> 
    <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-edit">
  Modifier <i class="fas fa-edit"></i>
</a>

<a href="logout.php" class="btn btn-logout">
  Se déconnecter <i class="fas fa-sign-out-alt"></i>
</a>

<a href="inscription.php" class="btn btn-register">
  Nouvel utilisateur<i class="fas fa-user-plus"></i>
</a>

</div>

<?php } else {
    echo "Aucun utilisateur trouvé.";
}
?>

</body>
</html>
