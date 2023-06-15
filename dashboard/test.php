<?php
require_once('../includes/db.php');

// Récupérer le nombre de stagiaires par institut
$stmt1 = $conn->prepare("SELECT institut, COUNT(*) as count FROM `2023` GROUP BY institut");
$stmt1->execute();
$result1 = $stmt1->get_result();

$institutes = array();
$count1 = array();
if ($result1->num_rows > 0) {
  // Stocker les résultats dans des tableaux
  while($row = $result1->fetch_assoc()) {
    array_push($institutes, $row["institut"]);
    array_push($count1, $row["count"]);
  }
}

// Récupérer le nombre de stagiaires par lieu
$stmt2 = $conn->prepare("SELECT COUNT(*) as count FROM `2023` WHERE lieu = 'ADM'");
$stmt2->execute();
$resultADM = $stmt2->get_result();
$countADM = $resultADM->fetch_assoc()["count"];

$stmt3 = $conn->prepare("SELECT COUNT(*) as count FROM `2023` WHERE lieu = 'Usine'");
$stmt3->execute();
$resultUsine = $stmt3->get_result();
$countUsine = $resultUsine->fetch_assoc()["count"];

$lieux = array("ADM", "Usine");
$count2 = array($countADM, $countUsine);
// Récupérer le nombre de stagiaires par encadrant
$stmt4 = $conn->prepare("SELECT tuteur, COUNT(*) as count FROM `2023` GROUP BY tuteur");
$stmt4->execute();
$result2 = $stmt4->get_result();

$tuteurs = array();
$count3 = array();
if ($result2->num_rows > 0) {
  // Stocker les résultats dans des tableaux
  while($row = $result2->fetch_assoc()) {
    array_push($tuteurs, $row["tuteur"]);
    array_push($count3, $row["count"]);
  }
}
// Récupérer le nombre de stagiaires par personne ayant recommandé
$stmt4 = $conn->prepare("SELECT recommander, COUNT(*) as count FROM `2023` WHERE recommander IS NOT NULL GROUP BY recommander");
$stmt4->execute();
$result4 = $stmt4->get_result();

$recommenders = array();
$count4 = array();
if ($result4->num_rows > 0) {
  // Stocker les résultats dans des tableaux
  while($row = $result4->fetch_assoc()) {
    array_push($recommenders, $row["recommander"]);
    array_push($count4, $row["count"]);
  }
}
// Récupérer le nombre de stagiaires par service
$stmt5 = $conn->prepare("SELECT metier, COUNT(*) as count FROM `2023` GROUP BY metier");
$stmt5->execute();
$result5= $stmt5->get_result();

$services = array();
$count5 = array();
if ($result5->num_rows > 0) {
  // Stocker les résultats dans des tableaux
  while($row = $result5->fetch_assoc()) {
    array_push($services, $row["metier"]);
    array_push($count5, $row["count"]);
  }
}
// Récupérer le nombre de stagiaires par sexe
$stmt6 = $conn->prepare("SELECT sexe, COUNT(*) as count FROM `2023` GROUP BY sexe");
$stmt6->execute();
$result6 = $stmt6->get_result();

$sexes = array();
$count6 = array();
if ($result6->num_rows > 0) {
  // Stocker les résultats dans des tableaux
  while($row = $result6->fetch_assoc()) {
    array_push($sexes, $row["sexe"]);
    array_push($count6, $row["count"]);
  }
}






// Définition des options pour le premier cercle
$options1 = [
  'series' => $count1,
  'chart' => [
    'width' => 380,
    'type' => 'pie'
  ],
  'labels' => $institutes,
  'colors' => ['#F5DEB3', '#D2B48C', '#BC8F8F', '#A0522D', '#8B4513']];

// Définition des options pour le deuxième cercle
$options2 = [
  'series' => $count2,
  'chart' => [
    'width' => 380,
    'type' => 'pie'
  ],
  'labels' => $lieux,
  'colors' => ['#996515', '#CBA135']
];
// Définir les options pour le troisieme cercle
$options3 = [
  'series' => $count3,
  'chart' => [
    'width' => 380,
    'type' => 'pie'
  ],
  'labels' => $tuteurs,
  'colors' => ['#F08080', '#CD5C5C','#A52A2A', '#800000', '#660000']
];
// Définir les options pour le quatrième cercle
$options4 = [
  'series' => $count4,
  'chart' => [
    'width' => 380,
    'type' => 'pie'
  ],
  'labels' => $recommenders,
  'colors' => ['#E2DED9', '#C4BCB4', '#A69E8A', '#887F61', '#6A6242']
];


// Définir les options pour le quatrième cercle
$options5 = [
  'series' => $count5,
  'chart' => [
    'width' => 380,
    'type' => 'pie'
  ],
  'labels' => $services,
  'colors' => ['#8B7500', '#DAA520', '#F0E68C', '#FFFACD', '#FAFAD2']];
    // Définir les options pour le sixième cercle
$options6 = [
  'series' => $count6,
  'chart' => [
    'width' => 380,
    'type' => 'pie'
  ],
  'labels' => $sexes,
  'colors' => ['#E8D8C3', '#C3A77B']
];
?> 



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Statistiques</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <div id="chart1"></div>
  <div id="chart2"></div>
  <div id="chart3"></div>
  <div id="chart4"></div>
  <div id="chart5"></div>
  <div id="chart6"></div>





  <script>
    var options1 = <?php echo json_encode($options1); ?>;
    var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
    chart1.render();

    var options2 = <?php echo json_encode($options2); ?>;
    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
    chart2.render();

    var options3 = <?php echo json_encode($options3); ?>;
    var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
    chart3.render();
    
    var options4 = <?php echo json_encode($options4); ?>;
    var chart4 = new ApexCharts(document.querySelector("#chart4"), options4);
    chart4.render();

    var options5 = <?php echo json_encode($options5); ?>;
var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
chart5.render();

var options6= <?php echo json_encode($options6); ?>;
var chart6 = new ApexCharts(document.querySelector("#chart6"), options6);
chart6.render();
  </script>
</body>
</html>
