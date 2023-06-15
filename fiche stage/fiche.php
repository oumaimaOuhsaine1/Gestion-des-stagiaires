<?php
require '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupération des informations du stagiaire depuis la table "stagiaires"
    $sql_stagiaire = "SELECT * FROM `2023` WHERE id = '$id'";
    $result_stagiaire = mysqli_query($conn, $sql_stagiaire);

    if (mysqli_num_rows($result_stagiaire) == 1) {
        $stag = mysqli_fetch_assoc($result_stagiaire);
    } else {
        // echo "Aucun stagiaire trouvé avec l'ID $id";
    }
} else {
    // echo "ID du stagiaire non spécifié dans la requête GET";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @media print {
            .np{
                display:none;
            }
        }
    </style>
</head>
<body>
    <header style="display: flex;">
        <div>
            <img src="entete papeterie.png" alt="" style="height: 150px; width: 400px;">
        </div>
        <div style="margin-left: 280px;">
            <h3 style="background-color: gray;color: white; font-size: large; border: 1px; padding: 10px; ">
                DOSSIER STAGIAIRE
            </h3>
            <section style="display: flex;border: 1px black solid;">
                <hr style="margin: 10px;">
                <h5>
                Directeur Exécutive Capital Humain</h5>
                <hr style="margin: 10px;">
                <br>
                <h4>.........................................</h4>
            </section>
            
        </div>
    </header> <br>
    <br><br><br>
    <main>
        <span style="border: 1px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 80px;">Matricule:</strong></span>
        <span style="border: 1px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 200px;"><?=$stag['matricule']?></strong></span>
        <span style="border: 1px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 80px;">Matricule Pointage:</strong></span>
        <span style="border: 1px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 200px;"></strong></span>
        <br>
        <br>
        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">FICHE SIGNALITIQUE</h5>
        <table > 
            <tr><td style="border: 1px black solid;padding: 10px;width: 2000px;"><span style="font-size: small; padding-right: 80px;">Nom & Prénom</span>: <span><?=$stag['nom']?> <?=$stag['prenom']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 55px;">Téléphone personnel</span>: <span><?=$stag['telephone']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 70px;">Date de naissance</span>: <span><?=$stag['date_naissance']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 145px;">Cin</span>: <span><?=$stag['cin']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 55px;">Adresse actuelle CIN</span>: <span><?=$stag['ville']?></span></td></tr>
        </table>
        <br><br>
        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">PERSONNES A CONTACTER EN CAS D'URGENCE</h5>
        <table > 
            <tr><td style="border: 1px black solid;padding: 10px;width: 2000px;"><span style="font-size: small; padding-right: 80px;">Nom & Prénom</span>: <span></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 110px;">Téléphone</span>: <span></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 85px;">Lien de parenté</span>: <span></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 55px;">Adresse actuelle CIN</span>: <span></span></td></tr>
        </table>
        <br><br>
        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">CARRACTERISTIQUES DU STAGE</h5>
        <table > 
            <tr><td style="border: 1px black solid;padding: 10px;width: 2000px;"><span style="font-size: small; padding-right: 145px;">Ecole</span>: <span><?=$stag['institut']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 95px;">Nature de stage</span>: <span><?=$stag['nature_stage']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 70px;">Recommandé(e) par</span>: <span><?=$stag['recommander']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 18px;">Direction/Service d'affectation</span>: <span><?=$stag['service']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 97px;">Tuteur de stage</span>: <span><?=$stag['tuteur']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 68px;">Le stage se déroulera</span>: <span>DU <?=$stag['date_debut']?> AU <?=$stag['date_fin']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 53px;">Si prolongation de stage</span>: <span style="font-weight:bold;">DU </span><span style="padding-right: 183px;"><?=$stag['date_debut']?></span><span style="font-weight:bold;">AU </span><span><?=$stag['date_fin']?></span></td></tr>
        </table>
       <br><br><br><br><br>

        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">RAPPORT DE STAGE ET ATTESTATION</h5>
            <p><span style="border: 2px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 80px;">Rapport de stage:</strong></span>
            <span style="border: 1px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 90px;"><input type="checkbox" name="Depose" >Depose<input style="margin-left: 60px;"type="checkbox" name="Non Depose">Non Depose</strong></span>
            <span style="border: 2px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 80px;">Date de dépot:</strong></span>
            <span style="border: 1px black solid; padding: 10px; font-size: small;"><strong style="margin-right: 130px;"></strong></span>
            </p>
            <table > 
            <tr><td style="border: 1px black solid;padding: 10px;width: 2000px;"><span style="font-size: small; padding-right: 130px;">Théme du stage</span>: <span></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 70px;">Date de remise d'attestation</span>: <span></span></td></tr>
        </table>
        <br><br><br>
        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">RAPPORT DE STAGE ET ATTESTATION</h5>
        <input type="checkbox"><label style="font-weight: bolder;font-size: x-large;">Rapport délivré</label><br>
        <input type="checkbox"><label style="font-weight: bolder;font-size: x-large;">Attestation délivrée</label><br><br><br><br>
        <br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>
        <br><br><br><br><br>
        <br><br><br><br><br>
        <br><br><br><br><br>
        <br><br><br><br><br>
        <br><br><br>
        <br><br><br><br><br>
</main>
    <footer>
        <h6 style="color: gray;text-align: center;">Edition : 01/2020    Version : V1.00     Réf : C-CH-004</h6>
    </footer>
</body>
<body>
    <hr> <br>
    <header style="display: flex;">
        <div>
            <img src="entete papeterie.png" alt="" style="height: 150px; width: 400px;">
            
        </div>
        <div style="margin-left: 280px;">
            <h3 style="background-color: gray;color: white; font-size: large; border: 1px; padding: 10px; ">
                DOSSIER STAGIAIRE
            </h3>
            <section style="display: flex;border: 1px black solid;">
                <hr style="margin: 10px;">
                <h5>
                Directeur Exécutive Capital Humain</h5>
                <hr style="margin: 10px;">
                <br>
                <h4>.........................................</h4>
            </section>
            
        </div>
    </header> <br>
    <main>
        <h2 style="text-align: center;">CONVENTION DE STAGE</h2>
        <h4 style="font-weight: bold;">Article 1 : Objet</h4>
        <p style="font-size: small; margin-left: 30px;">La présente convention régle les rapports  entre :</p>
        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">D'une part L'entreprise</h5>
        <table > 
            <tr><td style="border: 1px black solid;padding: 10px;width: 2000px;"><span style="font-size: small; padding-right: 45px;">Raison sociale</span>: <span style="font-weight: bold;">MENARA HOLDING</span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 80px;">Adresse</span>: <span style="font-weight: bold;">KM 0.500 ROUTE D'AGADIR 40005 MARRAKECH</span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 68px;">Téléphone</span>: <span style="font-weight: bold;">+212 524 49 99 00</span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 103px;">Fax</span>: <span style="font-weight: bold;">+212 524 34 10 48</span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 91px;">Email</span>: <span style="font-weight: bold;">info@groupe-menara.com</span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 36px;">Représentée par </span>: <span style="font-weight: bold;">M.Amine NOURI</span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 55px;">En qualité de</span>: <span style="font-weight: bold;">DIRECTEUR EXECUSIF CAPITAL HUMAIN</span></td></tr>
        </table>

        <h5 style="text-align: center;color: white;background-color: black;font-size: small;border: 1px; padding: 10px;">Et d'autre part le stagiaire</h5>
        <table > 
            <tr><td style="border: 1px black solid;padding: 10px;width: 2000px;"><span style="font-size: small; padding-right: 40px;">Nom & Prénom</span>: <span><?=$stag['nom']?> <?=$stag['prenom']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 80px;">Adresse</span>: <span><?=$stag['ville']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 68px;">Télephone</span>: <span><?=$stag['telephone']?></span></td></tr>
            <tr><td style="border: 1px black solid;padding: 10px;"><span style="font-size: small; padding-right: 30px;">Sous le tutorat de </span>: <span><?=$stag['tuteur']?></span></td></tr>
        </table>
        <br><br><br>
        <h4 style="font-weight: bold;">Article 2 : Durée du stage</h4>
         <p><span>Le stage se déroulera Du  </span><span style="margin-right: 200px;"><?=$stag['date_debut']?></span><span>AU  </span><span><?=$stag['date_fin']?></span><br><br>
            Le stagiaire est tenu de respecter la durée du stage. La prolongation de cette durée est soumise obligatoirement à la validation <br> de la direction des ressources humaines.
        </p><br><br> <br><br><br><br><br>

    </main>
    <footer>
        <h6 style="color: gray;text-align: center;">Edition : 01/2020    Version : V1.00     Réf : C-CH-004</h6>
    </footer><hr><br><br>
    
    <header style="display: flex;">
        <div>
        <img src="entete papeterie.png" alt="" style="height: 150px; width: 400px;">

        </div>
        <div style="margin-left: 280px;">
            <h3 style="background-color: gray;color: white; font-size: large; border: 1px; padding: 10px; ">
                DOSSIER STAGIAIRE
            </h3>
            <section style="display: flex;border: 1px black solid;">
                <hr style="margin: 10px;">
                <h5>
                Directeur Exécutive Capital Humain</h5>
                <hr style="margin: 10px;">
                <br>
                <h4>.........................................</h4>
            </section>
            
        </div>
    </header> <br>
    <main>
        <h4 style="font-weight: bold;">Article 3 : Lieu du stage</h4>
        <p>Le stage se déroulera</p>
        <p>Au site : .................... SITE .......................................................................................................................................................................................................................</p>
        <p>Direction/service :</p>
        <ol style="margin-left: 50px;">
            <li>Service</li>
            <li></li>
            <li></li>
            <li></li>
        </ol>
        <br><br>

        <h4 style="font-weight: bold;">Article 4 : Assurance</h4>
        <p>Le stagiaire doit disposer d'une assurance de responsabilité civile contactée par l'établissement où il poursuit <br> ses études ou par le stagiaire lui-même.</p>
         <br><br>
        <h4 style="font-weight: bold;">Article 5 : Condition du dérourelement du stage</h4>
        <p>Pendant le stage, le stagiaire sera strictement soumis (e) aux règles disciplinaires applicables au personnel <br> de l’entreprise</p>
        <p>Le respect de l'horaire</p>
        <ul style="margin-left: 50px;">
            <li>L’horaire administratif : de 8h à 12h & de 14h30 à 18h30.</li>
            <li>L’horaire production (Usine, Carrières et Atelier) : fixé par le responsable de stage et sera communiqué au stagiaire au début du stage</li>
        </ul>
        <p>Les stagiaires sont invités à se présenter au lieu de stage en tenue décente et à avoir un comportement correct à l’égard <br> de toute personne présente dans l’organisme</p>
        <p>Toute absence doit être signalée au tuteur et à la direction exécutive capitale humaine via le formulaire (autorisation <br> de sortie ou autorisation d’absence) qui doit être remis pour validation au responsable des ressources humaines après visa <br> du tuteur de stage</p>
        <p>Horaire cafeteria 15 min (10h00-10h15 ou 10h15-10h30) <br>En cas de manquement à la discipline, la direction exécutive capitale humaine se réserve le droit de mettre fin au stage,<br> Après avoir avisé le stagiaire
        </p>
        <br><br><br><br><br>
        <br><br><br><br><br>
    </main>
    <footer>
        <h6 style="color: gray;text-align: center;">Edition : 01/2020    Version : V1.00     Réf : C-CH-004</h6>
    </footer><hr>
    <br><br>
    
    <header style="display: flex;">
        <div>
        <img src="entete papeterie.png" alt="" style="height: 150px; width: 400px;">

        </div>
        <div style="margin-left: 280px;">
            <h3 style="background-color: gray;color: white; font-size: large; border: 1px; padding: 10px; ">
                DOSSIER STAGIAIRE
            </h3>
            <section style="display: flex;border: 1px black solid;">
                <hr style="margin: 10px;">
                <h5>
                Directeur Exécutive Capital Humain</h5>
                <hr style="margin: 10px;">
                <br>
                <h4>.........................................</h4>
            </section>
            
        </div>
    </header> <br>
    <h4 style="font-weight: bold;">Article 6 : Evaluation du stagiaire</h4>
    <p>Un suivi régulier du stagiaire est assuré par l’encadrant et formalisé par une fiche d’évaluation. Une copie de <br> cette fiche est remise à la DCH à la fin de la période du stage.</p><br>
    <h4 style="font-weight: bold;">Article 7 : Rapport et attestation de stage</h4>
    <p>A la fin du stage, le stagiaire doit fournir un rapport de stage. Ce rapport est remis à la direction des Capital <br> humain afin de délivrer au stagiaire une attestation de stage indiquant la nature et la durée de son stage.</p> <br> <br>
    <?php  
    $date = date('Y-m-d');
    ?>
    <p style="margin-left: 700px;">Lu et Approuvé le <span><?php echo $date ?></span></p><br>
    <div style="display: flex;">
    <table style="border: 1px solid black; width: 250px;margin-right: 590px;">
        <tr>
            <th style="padding: 10px; color: white;font-weight: bold;text-align: center;background-color: black;">La Société <br> Représentée par</th>
        </tr>
        <tr>
            <td style="height: 140px;"></td>
        </tr>
    </table>
    <table style="border: 1px solid black; width: 250px;">
        <tr>
            <th style="padding: 10px; color: white;font-weight: bold;text-align: center;background-color: black;">Le stagiaire</th>
        </tr>
        <tr>
            <td style="height: 140px;"></td>
        </tr>
    </table>
   </div>
   <br><br>
   <br><br><br><br><br><br><br><br><br><br><br><br>
   <br><br><br><br><br>
   <br><br><br><br><br>
   <br><br><br><br><br>
   <footer>
    <h6 style="color: gray;text-align: center;">Edition : 01/2020    Version : V1.00     Réf : C-CH-004</h6>
</footer>
</body>
<script>
      window.print();
</script>
</html>