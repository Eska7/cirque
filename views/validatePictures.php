<?php
	require_once "config/config.inc";
	
	$namePage = "validatePictures";
	$deleted = false;
	$validate = false;
	$db = SPDO::getInstance();
	$q = "";

	if ( isset( $_GET['delete'] ) ) :
		$id = $_GET['id'];
		$q .= "delete from picture where id='$id';";
		$db->exec($q);
		$deleted = true;
	endif;

	if ( isset( $_GET['validate'] ) ) :
		$id = $_GET['id'];
		$q .= "update picture set valid = 0 where id='$id';";
		$db->exec($q);
		$validate = true;
	endif;

	$query = "select id, date from picture where valid=1";
	if ( isset( $_GET['orderby'] ) )
		$query .= " order by " . $_GET['orderby'];
	if ( isset( $_GET['desc'] ) )
		$query .= " desc";
	$query .= ";";
	$desc = isset( $_GET['desc'] ) ? false : "&amp;desc";
	
	$stmt = $db->prepare($query);
	$stmt->execute();
	$count = $stmt->rowcount();
	$validatePictures = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php print TITLE; ?>Valider les photos</title>

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
								Valider les photos
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
							Cette photo a été supprimée.
						</div>
					<?php endif; 
					if ( $validate ) : ?>
						<div class="alert alert-success">
							Cette photo a été validé.
						</div>
					<?php endif; ?>
					<br>
					<table class="table">
						<tbody>
							<?php
								print $count;

								//TODO
								$colnames = array();
								$data = array();
								$data = array_merge((array) $validatePictures, $data);
								foreach( $data as $row ) :
									print '<tr>';
									$colnames = array();
									foreach( $row as $key => $value ) :
										$colnames[] = $key;
										print '<td>';
										print utf8_encode($value);
										print '</td>';
									endforeach;
									print '<td><a href="?page='.$namePage.'&amp;validate&amp;id='.$row['id'].'" onClick="return confirm(\'Voulez-vous vraiment valider cette photo ?\')"><span class="glyphicon glyphicon-ok"></span></a></td>';
									print '<td><a href="?page='.$namePage.'&amp;delete&amp;id='.$row['id'].'" onClick="return confirm(\'Voulez-vous vraiment supprimer cette photo ?\')"><span class="glyphicon glyphicon-trash"></span></a></td>';
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
									Valider
								</th>
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
