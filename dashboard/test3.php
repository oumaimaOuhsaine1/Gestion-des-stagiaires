<?php
include('../includes/db.php');

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Requête SQL pour récupérer le nombre de demandes en attente pour la date sélectionnée
$sql = "SELECT DATE(created_at) AS date, COUNT(*) AS total_demandes FROM cvs GROUP BY DATE(created_at)='$date'";
$result = $conn->query($sql);

$count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['total_demandes'];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
      body {
      display: flex;
      align-items: center;
      margin: 0;
    }
    .card {
      border: 1px solid #A49367;
      background-color: #A49367;
      padding: 20px;
      padding-left:-30px;
      padding-left:-70px;
      color: white;
      border-radius: 10px;
      box-shadow: none;
      margin:10px;
      display: flex;
      align-items: center;
      flex-direction: column;
      
    }

    .card h3 {
      margin: 0;
      font-size: 20px;
      font-weight: bold;
      font-family: "Dax Medium", sans-serif;
    }

    .card p {
      margin: 0;
      font-size: 16px;
      font-family: "Dax Light", sans-serif;
    }

    .form-container {
      /* margin-left: auto;
      display: flex;
      align-items: center; */
    }

    .form-container input[type="date"] {
      padding: 10px;
      font-size: 14px;
    }

   
  </style>
</head>
<body>
  <div class="card">
    <h3>Demandes en attente</h3>
    <div class="form-container">
    <p><?php echo $count; ?></p>

      <!-- <img src="calendar-icon.png" alt="Calendar Icon" class="calendar-icon"> -->
      <input type="date" id="selected-date" name="date" value="<?php echo $date; ?>">
    </div>
  </div>

  <script>
    document.getElementById('selected-date').addEventListener('change', function() {
      var selectedDate = this.value;
      window.location.href = '?date=' + selectedDate;
    });
  </script>
</body>
</html>
