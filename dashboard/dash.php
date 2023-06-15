<?php
include('../includes/db.php');
// demande 
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$sql = "SELECT COUNT(*) AS total_demandes FROM cvs WHERE DATE(created_at) = '$date'";
$result = $conn->query($sql);

$count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['total_demandes'];
}

// accepter 
$current_date = date('Y-m-d');
$current_month = date('m');
$current_year = date('Y');
$date_debut = $current_year . '-' . $current_month . '-01';
$date_fin = date('Y-m-t', strtotime($date_debut));

if (isset($_GET['date'])) {
  $current_date = $_GET['date'];
  $date_debut = $current_date;
  $date_fin = $current_date;
}

$sql = "SELECT COUNT(*) AS total_stagiaires FROM `2023` WHERE date_debut <= '$date_fin' AND date_fin >= '$date_debut'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$accept = $row['total_stagiaires'];

// expire 
$date_jour = date('d/m');
$date_semaine = date('d/m', strtotime('+1 week'));
$query = "SELECT * FROM `2023` WHERE date_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 WEEK) ORDER BY date_fin ASC";
$result = mysqli_query($conn, $query);
$expire = mysqli_num_rows($result);

// tuteur 
$current_date = date('Y-m-d');
$sql = "SELECT DISTINCT (tuteur) AS total_tuteurs FROM `2023`";
$result = mysqli_query($conn, $sql); 
$total_tuteurs = mysqli_num_rows($result);

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
  'colors' => ['#D2B48C', '#C39E82', '#A9826B', '#8B735C', '#715B4E']

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
    'width' => 450,
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

$sql = "SELECT MONTH(date_debut) AS mois, COUNT(*) AS total_stagiaires FROM `2023` GROUP BY MONTH(date_debut)";
$result = $conn->query($sql);

// Création d'un tableau de données pour le graphique
$data = array_fill(1, 12, 0); // Initialisation avec des zéros pour chaque mois

while ($row = $result->fetch_assoc()) {
  $month = (int)$row['mois'];
  $data[$month] = (int)$row['total_stagiaires'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

	 <!-- Montserrat Font -->
	 <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    @import url("https://fonts.googleapis.com/css?family=Open+Sans&display=swap");
      body {
      display: flex;
      align-items: center;
      margin: 0;
    }
    .main-container {
			width:1010px;
			margin-left:280px;
			grid-area: main;
			overflow-y: auto;
			padding: 20px 20px;
			color: rgba(255, 255, 255, 0.95);
}
.main-cards {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  /* gap: 10px; */
  margin: 10px 0;
}

    .card {
      border: 1.5px solid #A49367;
      /* background-color: #A49367; */
      padding: 20px;
      padding-left:-20px;
      padding-left:-50px;
      color: black;
      border-radius: 5px;
      box-shadow: none;
      margin:5px;
      display: flex;
      align-items: center;
      flex-direction: column;
      width:220px
      
    }

    .card h3 {
      margin: 0;
      font-size: 17px;
      font-weight: bold;
      font-family: "Dax Medium", sans-serif;
      color: #A49367;
      
    }

    .card h5 {
      margin: 0;
      margin-top: 10px;
      font-size: 19px;
      font-family: "Dax Light", sans-serif;
      text-align:center;
      font-weight: bold;
      
       
    }
    .card h6{
      margin: 0;
      margin-top: 10px;
      font-size: 14px;
      font-family: "Dax Light", sans-serif;
      text-align:center;
      font-weight: bold;
      
       
    }

    .form-container {
      /* margin-left: auto;
      display: flex;
      align-items: center; */
    }

    .form-container input[type="date"] {
      padding: 10px;
      font-size: 14px;
      border:0px;
      color:black;
      font-weight: bold;
      font-family: "Dax Medium", sans-serif;
    }
    .chart {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
margin-left:400px;
  max-width: 1200px;
}
.charts-card {
  background-color: #263043;
  margin-bottom: 20px;
  padding: 25px;
  box-sizing: border-box;
  -webkit-column-break-inside: avoid;
  border-radius: 5px;
  box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
}

.chart-title {
  display: flex;
  align-items: center;
  justify-content: center;
}

.group {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  margin: 20px;
  
}

.group h4 {
  font-family: Dax Light;
  font-size: 20px;
  margin: 0 10px;
  color:#A49367;
  font-weight: bold;
}

.chart1, .chart2 {
  width: 450px;
  height: 350px;
  margin: 20px;
  border: 1.5px solid #A49367;
  padding:10px;
}
.chart3{
  text-align:center;
  width: 850px;
  height: 400px;
  margin: 20px;
  border: 1.5px solid #A49367;
  padding:10px;
  margin-left:50px;
}
.diag{
  color:black;
}

.group > div {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.group > div > h4 {
  font-family: Dax Medium;
  font-size: 20px;
  margin: 10px 0;
}

.group > div > p {
  font-family: Dax Light;
  font-size: 16px;
  margin: 0;
}
@media screen and (max-width: 768px) {
  .main-cards {
    grid-template-columns: 1fr;
    gap: 10px;
    margin-bottom: 0;
  }

  .charts {
    grid-template-columns: 1fr;
    margin-top: 30px;

  }
}

   
  </style>
</head>
<body>
<section id="sidebar">
	<?php include('../includes/sidebar.php')?>
</section>
<div class="main-container">
<div class="main-cards">
  <div class="card">
    <h3>Demandes en attente</h3>
    <div class="form-container">
    <h5><?php echo $count; ?></h5>

      <!-- <img src="calendar-icon.png" alt="Calendar Icon" class="calendar-icon"> -->
      <input type="date" id="selected-date" name="date" value="<?php echo $date; ?>">
    </div>
  </div>

  <div class="card" >
    <h3>Nombre de Stagiaire</h3>
    <div class="form-container">
        <h5><?php echo $accept; ?></h5>
        <input type="date" id="selected-date" name="date" value="<?php echo $current_date; ?>">
    </div>
</div>

<div class="card" style="padding:25px">
    <h3>Nombre de Départ</h3>
    <div class="form-container">
        <h5><?php echo $expire; ?></h5>
        <!-- <input type="date" id="selected-date" name="date" value="<?php echo $current_date; ?>"> -->
         <h6><?=   $date_jour . " - " . $date_semaine  ?></h6>
    </div>
   
</div>

<div class="card" style="padding:25px">
    <h3>Nombre d'encadrant</h3>
    <div class="form-container">
        <h5><?php echo $total_tuteurs; ?></h5>
        <!-- <input type="date" id="selected-date" name="date" value="<?php echo $current_date; ?>"> -->
         <h6><?=   $current_date  ?></h6>
    </div>
   
</div>
</div>
<div class="group" >
  <div class="chart-card">
    <div class="chart1">
    <h4 style="text-align:center;">Nombre de stagiaire par établissement</h4>
    <br>
    <div id="chart1" ></div></div>
  </div>
  <div class="chart-card">
   <div class="chart2"> 
    <h4 style="text-align:center;">Nombre de stagiaire ( Usine VS Administration)</h4>
    <br>
    <div id="chart2" ></div></div>
  </div>
</div>

  
  <div class="group">
    <div class="chart-card">
    <div  class="chart1"><h4 style="text-align:center;">Nombre de stagiaire par Encadrant</h4><br>
    <div id="chart3"></div></div>
    </div>
    <div class="chart-card">
   <div class="chart2"> <h4 style="text-align:center;">Nombre de stagiare recommander par</h4><br>
    <div id="chart4" ></div></div>
   </div>
  </div>

  <div class="group">
    <div class="chart-card">
   <div class="chart1"> <h4 style="text-align:center;">Nombre de stagaire par service</h4><br>
    <div id="chart5" style='padding-left:3px;'></div></div>
   </div>
   <div class="chart-card">
    <div  class="chart2"><h4 style="text-align:center;">Nombre de stagaire par sexe</h4><br>
    <div id="chart6"></div></div>
  </div>
  </div>
  <div class="diag">
    <div class="chart-card">
      <div class="chart3">
    <div id="chart"></div></div>
    </div>
  </div>
  </div>
</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="../js/script.js"></script>
	<script src="../js/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <script>
    document.getElementById('selected-date').addEventListener('change', function() {
      var selectedDate = this.value;
      window.location.href = '?date=' + selectedDate;
    });
  </script>
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
 
 <script>
    var options = {
      series: [{
        name: "Stagiaires",
        data: <?php echo json_encode(array_values($data)); ?>
      }],
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight',
        colors: ['#A49367']
      },
      title: {
        text: 'Nombre de stagiaires par mois',
        align: 'center',
        style: {
          fontFamily: 'Dax',
          fontSize: '20px',
          fontWeight: 'bold',
          textAlign: 'center',
          textAnchor: 'middle',
          fill: '#333333'
          },
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'],
          opacity: 0.5
        },
      },
      xaxis: {
        categories: [
          'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin',
          'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ]
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>
</body>
</html>
