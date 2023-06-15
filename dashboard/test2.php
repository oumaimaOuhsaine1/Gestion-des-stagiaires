<?php
  include('../includes/db.php');

  // Requête pour obtenir le nombre de stagiaires par mois
  $sql = "SELECT MONTH(date_debut) AS mois, COUNT(*) AS total_stagiaires FROM `2023` GROUP BY MONTH(date_debut)";
  $result = $conn->query($sql);

  // Création d'un tableau de données pour le graphique
  $data = array_fill(1, 12, 0); // Initialisation avec des zéros pour chaque mois

  while ($row = $result->fetch_assoc()) {
    $month = (int)$row['mois'];
    $data[$month] = (int)$row['total_stagiaires'];
  }

  // Fermeture de la connexion
  // $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Graphique des stagiaires par mois</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <style>
    #chart {
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <div id="chart"></div>

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
        align: 'left'
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
