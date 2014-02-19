<?php 
	require_once "config/config.inc";
	//Cirque irreversible
	//photo user+cirque
	//page profil user/perso
	//modal desc
?>
<!doctype html>
<html>

	<head>
		<meta charset="utf-8">
		<title><?php print TITLE; ?>Accueil</title>

		<link rel="stylesheet" type="text/css" href="global/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="global/css/admin-theme.css">
	</head>

	<body>

		<div class="container">
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<div class="padded"></div>
					<ul class="nav nav-pills nav-stacked">
						<li class="text-center active">
							<a href="">
							<span class="glyphicon glyphicon-home"></span>
								Home
							</a>
						</li>

						<li class="text-center">
							<a href="?page=validatePictures">
							<span class="glyphicon glyphicon-check"></span>
								Valider les photos
							</a>
						</li>

						<li class="text-center">
							<a href="?page=pictures">
							<span class="glyphicon glyphicon-picture"></span>
								Toutes les photos
							</a>
						</li>

						<li class="text-center">
							<a href="?page=circuses">
							<span class="glyphicon glyphicon-flag"></span>
								Tous les cirques
							</a>
						</li>

						<li class="text-center">
							<a href="?page=users">
							<span class="glyphicon glyphicon-user"></span>
								Tous les utilisateurs
							</a>
						</li>

						<li class="text-center">
							<a href="?page=events">
							<span class="glyphicon glyphicon-calendar"></span>
								Tous les evenements
							</a>
						</li>

					</ul>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					
				</div>
			</div>
		</div>

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="global/js/bootstrap.min.js"></script>
	</body>
</html>
