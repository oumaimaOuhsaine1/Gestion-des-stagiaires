<script src="https://kit.fontawesome.com/99c464b531.js" crossorigin="anonymous"></script>

<section id="sidebar">
		<a href="#" class="brand">
<img src="../images/Logo_mholding.png" alt=""  style="width: 200px; margin-top: 40px; margin-left: 30px;">		</a>
		<ul class="side-menu top">
			<li >
			<!-- class="active" -->
				<a href="dash.php">
				<i class="fas fa-chart-bar"></i>
					<span class="text" style="margin-left:20px;">Statistiques</span>
				</a>
			</li>
			<li>
				<a href="../dashboard/demande.php">
				<i class="fas fa-tasks"></i>
					<span class="text" style="margin-left:20px;">Demandes</span>
				</a>
			</li>
			<li>
				<a href="../dashboard/liste_stags.php">
				<i class="fas fa-check-circle"></i>
					<span class="text" style="margin-left:20px;">Demandes acceptées</span>
				</a>
			</li>
			<li>
				<a href="../dashboard/demande_refus.php">
				<i class="fas fa-times-circle"></i>
					<span class="text" style="margin-left:20px;">Demandes refusées</span>
				</a>
			</li>
			<li>
				<a href="../dashboard/stage_expire.php">
				<i class="fas fa-calendar-times"></i>
					<span class="text" style="margin-left:20px;">Stages expirés</span>
				</a>
			</li>
			<li>
				<a href="../dashboard/pointage.php">
				<i class="fas fa-clock"></i> 
				<span class="text" style="margin-left:20px;">Pointage</span>
				</a>
			</li>






		</ul>
		<ul class="side-menu">
			<li>
				<a href="../dashboard/profile.php">
				<i class="fas fa-user"></i>			
				<span class="text" style="margin-left:20px;">Mon Compte</span>
				</a>
			</li> <br> <br>
			<li>
				<a href="../dashboard/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Se déconnecter</span>
				</a>
			</li>
		</ul>
	</section>
	<script>
	RAPPORT TOGGLE 

var dropdown = document.querySelector('.dropdown');
		var dropdownMenu = document.querySelector('.dropdown-menu');

		dropdown.addEventListener('click', function(event) {
			event.stopPropagation();
			dropdownMenu.classList.toggle('show');
		});

		document.addEventListener('click', function(event) {
			if (!dropdown.contains(event.target)) {
				dropdownMenu.classList.remove('show');
			}
		});
	
		</script>
		<style>
			 .dropdown {
	position: relative;
	display: inline-block; 
} 
 .dropdown-menu {
	position: absolute;
	top: 100%;
	left: 0;
	z-index: 1;
	display: none;
	padding: 0;
	margin: 0;
	list-style: none;
	background-color: #f9f9f9;
	border: 1px solid #ccc;
	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.dropdown-menu li {
	padding: 10px;
	cursor: pointer;
	transition: background-color 0.2s;
}
.dropdown-menu li:hover {
	background-color: #ddd;
}
#sidebar .side-menu.top li.active a {
	color: #A39475;
}
#sidebar .side-menu.top li a:hover {
	color: #A39475;
}

		</style>
		