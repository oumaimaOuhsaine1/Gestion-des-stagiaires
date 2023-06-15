<?php
session_start(); // add this line to start the session

require('../includes/db.php');

if(isset($_POST['check_viewbtn']))
{
    $s_mat = $_POST['stag_Mat'];
    // echo $return = $s_mat;
    $query = "SELECT * FROM `2023` WHERE matricule='$s_mat'";									
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $stag)
        {
            echo $return = '
                
                    <h5> Matricule :'.$stag['matricule'].'</h5>
                    <h5>Cin :'.$stag['cin'].'</h5>
                    <h5>Nom :'.$stag['nom'].'</h5>
                    <h5>Prénom:'.$stag['prenom'].'</h5>
                    <h5>Sexe :'.$stag['sexe'].'</h5>
                    <h5>Date Debut :'.$stag['date_debut'].'</h5>
                    <h5>Date Fin :'.$stag['date_fin'].'</h5>
                    <h5>Date Naissance :'.$stag['date_naissance'].'</h5>
                    <h5>Niveau étude :'.$stag['niveau_etude'].'</h5>
                    <h5>Institut :'.$stag['institut'].'</h5>
                    <h5>Ville :'.$stag['ville'].'</h5>
                    <h5>Tuteur :'.$stag['tuteur'].'</h5>
                    <h5>Recommander :'.$stag['recommander'].'</h5>
                    <h5>Téléphone :'.$stag['telephone'].'</h5>
                    <h5>Observation :'.$stag['observation'].'</h5>
                    <h5>CV :</h5><a href="/dashboard/'.$stag['cv'].'">Télécharger le CV</a>
                    <h5>Photo :</h5><img src="uploads/'.$stag['photo'].'" alt="Photo de profil" height="200" width="200">            
            ';
        }
    }else
    {
        echo $return= "<h5> Aucun enregistrement trouvé</h5>";
    }
}



if (isset($_POST['check_Cvbtn'])) {
    $cv_id = $_POST['cv_id'];
    $query = "SELECT * FROM cvs WHERE id='$cv_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $stag) {
            $image_path = '/recrutement/' . $stag['picture'];
            $cv_path = '/recrutement/' . $stag['file_pdf'];
            echo $return = '
                <h5> Id :' . $stag['id'] . '</h5>
                <h5>Genre :' . $stag['gender'] . '</h5>
                <h5>Prénom :' . $stag['prenom'] . '</h5>
                <h5>Nom :' . $stag['nom'] . '</h5>
                <h5>Email :' . $stag['email'] . '</h5>
                <h5>Téléphone :' . $stag['telephone'] . '</h5>
                <h5>Ville :' . $stag['ville'] . '</h5>
                <h5>Intitule :' . $stag['intitule'] . '</h5>
                <h5>Métier :' . $stag['metier'] . '</h5>
                <h5>Année :' . $stag['annees'] . '</h5>
                <h5>Niveau :' . $stag['niveau'] . '</h5>
                <h5>Secteur :' . $stag['secteur_activite'] . '</h5>
                <button class="btn btn-info btn-sm" data-image="' . $image_path . '" onclick="showPhoto(' . $stag['id'] . ')">Photo</button>
                <button class="btn btn-info btn-sm" data-cv="' . $cv_path . '" onclick="showCV(' . $stag['id'] . ')">CV</button>
            ';
        }
    } else {
        echo $return = "<h5> Aucun enregistrement trouvé </h5>";
    }
}








if(isset($_POST['delete']))
{
    $matricule = mysqli_real_escape_string($conn, $_POST['delete']);

    $query = "DELETE FROM `2023` WHERE matricule='$matricule' ";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        // $_SESSION['message'] = "Stagiaire est supprimé avec succés";
        header("Location: liste_stags.php");
        exit(0);
    }
    else
    {
        // $_SESSION['message'] = "Stagiaire n'est pas supprimé";
        header("Location: liste_stags.php");
        exit(0);
    }
}


if(isset($_POST['supprimer']))
{
    $id = mysqli_real_escape_string($conn, $_POST['stag_id']); // Récupération de l'ID du stagiaire

    $query = "DELETE FROM `demande_refus` WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        // echo "zmer! Stag Deleted Successfully";
        $_SESSION['message'] = "Stag Deleted Successfully";
        header("Location:demande_refus.php");
        exit(0);
    }
    else
    {
        // echo "zmer! Stag Not Deleted: " . mysqli_error($con1);
        $_SESSION['message'] = "Stag Not Deleted";
        header("Location: demande_refus.php");
        exit(0);
    }
}
   

if(isset($_POST['update']))
{
    // $stag_matricule = mysqli_real_escape_string($con1, $_POST['matricule']);
    $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
    $cin = mysqli_real_escape_string($conn, $_POST['cin']);
    $nom= mysqli_real_escape_string($conn, $_POST['nom']); 
    $prenom= mysqli_real_escape_string($conn, $_POST['prenom']); 

    $sexe = mysqli_real_escape_string($conn, $_POST['sexe']);
    $datedebut = mysqli_real_escape_string($conn, $_POST['date_debut']);
    $datefin = mysqli_real_escape_string($conn, $_POST['date_fin']);
    $datenaissance = mysqli_real_escape_string($conn, $_POST['date_naissance']);
    $niveau= mysqli_real_escape_string($conn, $_POST['niveau_etude']); // replace '-' with '_'
    $institut = mysqli_real_escape_string($conn, $_POST['institut']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $tuteur = mysqli_real_escape_string($conn, $_POST['tuteur']);
    $recommander= mysqli_real_escape_string($conn, $_POST['recommander']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $observation = mysqli_real_escape_string($conn, $_POST['observation']);

    $query = "UPDATE `2023` SET matricule='$matricule', cin='$cin', nom='$nom',  prenom='$prenom',sexe='$sexe', date_debut='$datedebut', date_fin='$datefin', date_naissance='$datenaissance', niveau_etude='$niveau', institut='$institut', ville='$ville', tuteur='$tuteur', recommander='$recommander', telephone='$telephone', observation='$observation' WHERE matricule='$matricule'"; // replace $matricule with $stag_matricule

    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        // $_SESSION['message'] = "Stag Updated Successfully";
        header("Location: liste_stags.php");
        exit(0);
    }
    else
    {
        // $_SESSION['message'] = "Stag Not Updated";
        header("Location: liste_stags.php");
        exit(0);
    }
}

if(isset($_POST['save']))
{
    $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
    $cin = mysqli_real_escape_string($conn, $_POST['cin']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']); 
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']); 
    $sexe = mysqli_real_escape_string($conn, $_POST['sexe']);
    $datedebut = mysqli_real_escape_string($conn, $_POST['date_debut']);
    $datefin = mysqli_real_escape_string($conn, $_POST['date_fin']);
    $datenaissance = mysqli_real_escape_string($conn, $_POST['date_naissance']);
    $niveau = mysqli_real_escape_string($conn, $_POST['niveau_etude']); 
    $institut = mysqli_real_escape_string($conn, $_POST['institut']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $tuteur = mysqli_real_escape_string($conn, $_POST['tuteur']);
    $recommander = mysqli_real_escape_string($conn, $_POST['recommander']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $observation = mysqli_real_escape_string($conn, $_POST['observation']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $metier = mysqli_real_escape_string($conn, $_POST['metier']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    
    if(isset($_FILES['cv']) && $_FILES['cv']['error'] == 0 && isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
    
        $cv = $_FILES['cv'];
        $photo = $_FILES['photo'];
    
        $cv_ext = pathinfo($cv['name'], PATHINFO_EXTENSION);
        $photo_ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
    
        $valid_ext = array('pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png');
    
        if(in_array($cv_ext, $valid_ext) && in_array($photo_ext, $valid_ext)){
    
            $cv_name = uniqid() . '.' . $cv_ext;
            $photo_name = uniqid() . '.' . $photo_ext;
    
            move_uploaded_file($cv['tmp_name'], 'uploads/'.$cv_name);
            move_uploaded_file($photo['tmp_name'], 'uploads/'.$photo_name);
 
    
            // Vérifier que tous les champs obligatoires ont été remplis
            if(empty($matricule) || empty($cin) || empty($nom) || empty($prenom) || empty($sexe) || empty($datedebut) || empty($datefin) || empty($datenaissance)|| empty($niveau) || empty($institut) || empty($ville) || empty($telephone) || empty($email) || empty($metier) || empty($service)){
                $_SESSION['message'] = "Veuillez remplir tous les champs obligatoires.";
                header("Location: liste_stags.php");
                exit(0);
            } 
        
            // Insérer les données dans la base de données
            $query = "INSERT INTO `2023` (matricule, cin, nom, prenom,sexe, date_debut, date_fin, date_naissance, niveau_etude, institut, ville, tuteur, recommander, telephone, observation,email,metier,service,cv,photo) 
                      VALUES ('$matricule', '$cin', '$nom','$prenom','$sexe', '$datedebut', '$datefin', '$datenaissance', '$niveau', '$institut', '$ville', '$tuteur', '$recommander', '$telephone', '$observation','$email','$metier','$service','$cv_name','$photo_name')";
        
            $query_run = mysqli_query($conn, $query);
        
            if($query_run){
                $_SESSION['message'] = "StAG Created Successfully";
                header("Location: liste_stags.php");
                exit(0);
            }else{
                $_SESSION['message'] = "StAG Not Created";
                header("Location: liste_stags.php");
                exit(0);
            }
        }else{
            $_SESSION['message'] = "Veuillez remplir tous les champs obligatoires.";
            header("Location: liste_stags.php");
            exit(0);
        }
    }}       
?>
    
    
