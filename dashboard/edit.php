<?php
// inclure la connexion à la base de données
require_once('../includes/db.php');


// vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];

    // mettre à jour les données de l'utilisateur dans la base de données
    $sql = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', telephone='$telephone', password='$password' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    // rediriger vers la page précédente
    header('Location: profile.php');
    exit();
}

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  // récupérer les informations de l'utilisateur à partir de la base de données
  $sql = "SELECT * FROM users WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);
} else {
  // gérer l'absence de l'id
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier utilisateur</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
  font-family: 'Dax Light', sans-serif;
}

/*h1 {
  font-size: 20px;
  color: #A39475;
}

label {
  font-size: 16px;
}

input[type="text"],
input[type="password"] {
  font-size: 16px;
  border: 1px solid #D2CBCD;
  border-radius: 4px;
  margin-bottom: 20px;
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: #A39475;
  color: white;
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #C4BCB4;
}

input[type="submit"] {
  background-color: #A39475;
  color: white;
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #C4BCB4;
}

/* Polices */
@font-face {
  font-family: "Dax Light";
  src: url("path/to/DaxLight.ttf") format("truetype");
}

@font-face {
  font-family: "Dax Medium";
  src: url("path/to/DaxMedium.ttf") format("truetype");
}

  /* Ajout d'un padding à gauche pour réduire la taille du formulaire */
  #form-container {
    padding-left: 350px;
    padding-top:40px;
    margin-right: 50px;    
    background-color: #f2f2f2;
    width:100%;

  } 
 

  #form-container h1 {
  font-family: 'Dax Medium', sans-serif;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 40px;
}


label {
  display: inline-block;
  width: 200px; /* ajustez la largeur en fonction de vos besoins */
  text-align: right;
  margin-right: 10px; /* ajoutez un peu d'espace entre le label et l'input */
  font-family: Dax Light; /* spécifiez la police de caractère */
  font-size: 20px; /* spécifiez la taille de police */
}

input[type="text"], input[type="password"] {
  display: inline-block;
  width: 500px; /* ajustez la largeur en fonction de vos besoins */
  font-family: Dax Light; /* spécifiez la police de caractère */
  font-size: 20px; /* spécifiez la taille de police */
  /* padding-right: 100px; */
  border: 1px solid #A39475;
  border-radius: 5px;
  box-sizing: border-box;
}


/* input[type=submit] {
  background-color: #C4BCB4;
  color: #171717;
  padding-left:100px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width:800px;
} */
button[name="submit"] {
  background-color: #4472C4;
  color: #FFFFFF;
  font-family: Dax Light;
  font-size: 20px;
  font-weight: bold;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-left:290px;
}

button[name="submit"]:hover {
  background-color: #2F5597;
}


</style>


</head>
<body>
<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>
<div id="form-container">
    	<h1>Mise à jour des informations de l'administrateur</h1>
      <form method="POST" action="edit.php">
		<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
		<label for="nom">Nom:</label>
		<input type="text" name="nom" value="<?php echo $user['nom']; ?>"><br> <br>
		<label for="prenom">Prénom:</label>
		<input type="text" name="prenom" value="<?php echo $user['prenom']; ?>"><br> <br>
		<label for="email">Email:</label>
		<input type="text" name="email" value="<?php echo $user['email']; ?>"><br> <br>
		<label for="telephone">Téléphone:</label>
		<input type="text" name="telephone" value="<?php echo $user['telephone']; ?>"><br> <br>
		<label for="password">Mot de passe:</label>
		<input type="password" name="password"><br> <br>
        <div class="btn" style="text-align: center;">
  <button name="submit">
    <i class="fas fa-save"></i> Enregistrer
  </button>
</div>


</form>
    </div>
</section>
