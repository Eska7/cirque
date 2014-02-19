<?php
	require_once "config/config.inc";
	
	$namePage = "events";
	$deleted = false;
	$db = SPDO::getInstance();
	$q = "";

	if ( isset( $_GET['delete'] ) ) :
		$id = $_GET['id'];
		$q .= "delete from event where id='$id';";
		$db->exec($q);
		$deleted = true;
	endif;

	$query = "select e.id, e.fromDate, e.toDate, cit.name, cir.name from event e inner join circus cir on e.circus = cir.id inner join city cit on e.city = cit.id";
	if ( isset( $_GET['orderby'] ) )
		$query .= " order by " . $_GET['orderby'];
	if ( isset( $_GET['desc'] ) )
		$query .= " desc";
	$query .= ";";
	$desc = isset( $_GET['desc'] ) ? false : "&amp;desc";
	
	$stmt = $db->prepare($query);
	$stmt->execute();
	$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();


?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php print TITLE; ?>Photo</title>

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
						<li class="text-center">
							<a href="?page=home">
								<span class="glyphicon glyphicon-home"></span>
								Home
							</a>
						</li>

						<li class="text-center active">
							<a href="?page=<?php echo $namePage; ?>">
								<span class="glyphicon glyphicon-user"></span>
								Tous les évenements
							</a>
						</li>
					</ul>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<br>
					<?php if ( $deleted ) : ?>
						<div class="alert alert-danger">
							La ligne a été supprimée.
						</div>
					<?php endif; ?>
					<br>
					<table class="table">
						<tbody>
							<?php
								$colnames = array();
								$data = array();
								$data = array_merge((array) $events, $data);
								foreach( $data as $row ) :
									print '<tr>';
									$colnames = array();
									foreach( $row as $key => $value ) :
										$colnames[] = $key;
										print '<td>';
										print utf8_encode($value);
										print '</td>';
									endforeach;
									print '<td><a href="?page='.$namePage.'&amp;delete&amp;id='.$row['id'].'" onClick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')"><span class="glyphicon glyphicon-trash"></span></a></td>';
									print '</tr>';
								endforeach;
							?>
						</tbody>
						<thead>
							<tr>
								<?php
									foreach( $colnames as $colname ) :
										print '<th>';
										print '<a href="?page='.$namePage.'&amp;orderby='.$colname.$desc.'">';
										print utf8_encode($colname);
										print '</a>';
										print '</th>';
									endforeach;
								?>
								<th>
									Supprimer
								</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="global/js/bootstrap.min.js"></script>
	</body>
</html>
