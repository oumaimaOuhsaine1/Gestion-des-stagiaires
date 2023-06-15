<?php
include('../includes/db.php');
// Vérifie si le formulaire a été soumis
if(isset($_POST['inscrire'])) {

    // Vérifie si les champs obligatoires sont vides
    if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['telephone']) || empty($_POST['gender']) || empty($_POST['password'])) {
        $error_msg = "Veuillez remplir tous les champs obligatoires.";
    }
    else {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $gender = htmlspecialchars($_POST['gender']);

        // Statut par défaut : administrateur
        $statut = "administrateur";
     
        // Insère les données dans la base de données
        $sql = "INSERT INTO users (nom, prenom, email, password, telephone, gender, statut) VALUES ('$nom', '$prenom', '$email', '$password', '$telephone', '$gender', '$statut')";
        $result = mysqli_query($conn, $sql);

        if($result) {
            // Redirige l'utilisateur vers la page de connexion
            header('Location: profile.php');
            exit;
        }
        else {
            $error_msg = "Erreur lors de l'inscription.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des stagiaires</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/99c464b531.js" crossorigin="anonymous"></script>
    <style>
        body{
            width:100%;
            height:100vh;

        }
        .gender-container {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.gender-label {
  margin-right: 10px;
  font-weight: bold;
}

.gender-input {
  margin-right: 5px;
  margin-left: 5px;
}
.group img {
  width: 150px;
  margin-right: 20px; /* espace entre l'image et le titre */
  vertical-align: middle; /* alignement vertical de l'image */
}

.group h1 {
  display: inline-block;
  margin-bottom: 10px; /* réduction de l'espace entre l'image et le titre */
  font-size: 36px;
  font-weight: bold;
}
.container{

}


    </style>
</head>
<body>
 <div class="container">
<div class="form-box">
<div class="group">
<img src="images/entete.png" alt="" width=150px > <br> <br>
 <h1>Nouvel utilisateur</h1>
</div>
<form method='post'>
<?php if (isset($error_msg)): ?>
  <div class="error"><?php echo $error_msg; ?></div>
<?php endif; ?>
<div class="input-group">
<div class="input-field">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>">
</div>
<div class="input-field">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Prénom" name="prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>">
</div>
<div class="gender-container">
    <span class="gender-label">Genre:</span>
    <label for="gender-male" class="gender-input">Homme</label>
    <input type="radio" id="gender-male" name="gender" value="M"<?php if(isset($gender) && $gender === "M") echo " checked"; ?>>
    <label for="gender-female" class="gender-input">Femme</label>
    <input type="radio" id="gender-female" name="gender" value="F"<?php if(isset($gender) && $gender === "F") echo " checked"; ?>>
</div>
<div class="input-field">
    <i class="fas fa-phone"></i>
    <input type="number" placeholder="Téléphone" name="telephone" value="<?php echo isset($telephone) ? $telephone : ''; ?>">
</div>
<div class="input-field">
    <i class="fas fa-envelope"></i>
    <input type="text" placeholder="Email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
</div>
<div class="input-field">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Mot de passe" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
</div>




</div>
<div class="btn-field">
    <button type="submit" name="inscrire">S'inscrire</button>
</div>
</form>
</div>
</div>
</body>
</html>
