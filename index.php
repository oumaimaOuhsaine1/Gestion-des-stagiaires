<?php
// Démarrer une session
session_start();

// Inclure la configuration de la base de données
include('includes/db.php');

// Initialiser les variables de connexion
$email = "";
$password = "";

// Si le formulaire a été soumis
if (isset($_POST['login'])) {
	// Récupérer les informations d'identification soumises par l'utilisateur
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Vérifier si les informations d'identification sont correctes
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
    if (mysqli_num_rows($result) == 1) {
        // Informations d'identification correctes, stocker l'ID de l'utilisateur dans la variable de session
        $_SESSION['user_id'] = $row['id'];
        header('Location:dashboard/dash.php');
    } else {
        // Informations d'identification incorrectes, afficher un message d'erreur
        $error_msg = "votre email et password sont incorrect";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des stags</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/99c464b531.js" crossorigin="anonymous"></script>
</head>
<body>
 <div class="container">
<div class="form-box">
<div class="group">
<img src="images/Logo_mholding.png" alt="" width=150px > <br> <br><br>
 <h1>SE CONNECTER</h1>
</div>
   
    <form method="post">
    <?php if (isset($error_msg)): ?>
            	<div class="error"><?php echo $error_msg; ?></div>
            <?php endif; ?>
        <div class="input-group">
            <div class="input-field">
            <i class="fa-regular fa-id-card"></i>
                <input type="text" placeholder="Votre email" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="input-field">
            <i class="fa-solid fa-address-card"></i>
                <input type="password" placeholder="Votre password" name="password">
            </div>
            <!-- Afficher un message d'erreur si nécessaire -->
            
        </div>
        <div class="btn-field">
            <button name="login">Se connecter</button>
        </div>
    </form>
</div>

 </div>
 <!-- <style>
    .error {
  color: #c0392b;
  font-size: 16px;
  font-weight: bold;
  margin: 10px 0;
  padding: 10px;
  background-color: #f2dede;
  border: 1px solid #e6b4b4;
  border-radius: 4px;
}
.container{
    width:100%;
    height:100vh;
    background-image: linear-gradient(rgba(186, 185, 176, 0.6),rgba(186, 185, 176, 0.6)),url(images/menara.png);
    background-position: center;
    background-size:cover;
    position:relative;
}
.btn-field button{
flex-basis:60%;
background: #535252;
color:#fff;
height:40px;
border-radius:10px;
width:140px;
border:0;
outline:0;
cursor:pointer;
transition:background 1s;
}
.form-box h1{
    font-size:30px;
    margin-bottom:60px;
    color: black;   
          position:relative;
}
  
 </style> -->
 <style>
    .error {
        color: #8B0000;
  background-color: #f8d7da; /* Couleur rose pâle */
  border: 1px solid #dc3545; /* Bordure rouge foncé */
  padding: 10px; /* Espace intérieur */
  margin-bottom: 10px; /* Marge en bas */
  border-radius: 5px; /* Coins arrondis */
}

 </style>
</body>
</html>

