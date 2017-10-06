<?php
header('content-type: application/json; charset=utf-8');

if (! function_exists ( '_d' )) {
	function _d($v, $e = 0) {
		echo '<pre>';
		var_dump ( $v );
		echo '</pre>';
		if ($e)
			exit ();
	}
}

$dsn = 'mysql:dbname=farmen_se;host=localhost';
$user = 'farmen_se';
$password = 'nza7yxvUwyamsT3K';
	
try {
	$dbh = new PDO ( $dsn, $user, $password );
} catch ( PDOException $e ) {
	echo 'Connection failed: ' . $e->getMessage ();
}

if (isset ( $_GET ['find'] )) {
	
	if (! empty ( $_GET ['area'] ))	$area = $_GET ['area'];
	else $area = false;
	
	if (! empty ( $_GET ['street'] )) $street = $_GET ['street'];
	else $street = false;
	
	if ($dbh && $area && ! $street) {
		$sth = $dbh->query ( "select distinct (`address`) from farmen_area where `area` = '" . urldecode ( $area ) . "' order by `address`" );
		$addresses = $sth->fetchAll ( PDO::FETCH_COLUMN );
		echo json_encode ( $addresses );
		exit ();
	}
	
	
	
	if ($dbh && $street && $area) {
		$num = array ();
		$sth = $dbh->query ( "select `from_id`, `to_id` from farmen_area where `area` = '" . urldecode ( $area ) . "' and `address` = '" . urldecode ( $street ) . "'" );
		if ($sth) {
			$numbers = $sth->fetchAll ( PDO::FETCH_CLASS );
			if (! empty ( $numbers )) {
				foreach ( $numbers as $number ) {
					if ($number->from_id === $number->to_id) {
						$num [] = $number->from_id;
					} else if ($number->to_id > $number->from_id) {
						if (($number->to_id + $number->from_id) % 2 == 0) {
							for($i = $number->from_id; $i <= $number->to_id; $i = $i + 2) {
								$num [] = $i;
							}
						} else {
							for($i = $number->from_id; $i <= $number->to_id; $i ++) {
								$num [] = $i;
							}
						}
					}
				}
			}
		}
		$num = array_unique ( $num );
		sort ( $num );
		echo json_encode ( $num );
		exit ();
	}

}

if (isset ( $_POST ['calculate'] )) {
	$area_from = ! empty ( $_POST ['from'] ) ? $_POST ['from'] : false;
	$area_to = ! empty ( $_POST ['to'] ) ? $_POST ['to'] : false;
	
	$street_from = ! empty ( $_POST ['street-from'] ) ? $_POST ['street-from'] : false;
	$street_to = ! empty ( $_POST ['street-to'] ) ? $_POST ['street-to'] : false;
	$street_from_number = ! empty ( $_POST ['street-from-number'] ) ? $_POST ['street-from-number'] : false;
	$street_to_number = ! empty ( $_POST ['street-to-number'] ) ? $_POST ['street-to-number'] : false;
	$vehicle = ! empty ( $_POST ['vehicle'] ) ? $_POST ['vehicle'] : false;
	$urgencies = array ('samlastaren', 'budget', 'ekonomi', 'timmars', '2timmars', 'panik', 'miljo' );
	$results = array ();
	$from = false;
	$to = false;
	$z = 0;
	
	if (! $street_from || ! $street_to || ! $street_from_number || ! $street_to_number) {
		return false;
	}
	
	$sth = $dbh->query ( "select * from farmen_area where `area` = '{$area_from}' and `address` = '{$street_from}' and `from_id` <= '{$street_from_number}' and `to_id` >= '{$street_from_number}'" );
	if ($sth) {
		$_from = $sth->fetchObject ();
		if (! empty ( $_from ))
			$from = $_from->zone;
	}
	
	$sth = $dbh->query ( "select * from farmen_area where `area` = '{$area_to}' and `address` = '{$street_to}' and `from_id` <= '{$street_to_number}' and `to_id` >= '{$street_to_number}'" );
	if ($sth) {
		$_to = $sth->fetchObject ();
		if (! empty ( $_to ))
			$to = $_to->zone;
	}
	
	if (! $from || ! $to || ! $vehicle) {
		return false;
	}
	
	if ($dbh) {
		foreach ( $urgencies as $urgency ) {
			$result = '';
			$type = $urgency . '-' . $vehicle;
			
			// Get matrix
			$sth = $dbh->query ( "select * from farmen_matrix where from_id='{$from}' and to_id='{$to}'" );
			$matrix = $sth->fetchObject ();
			
			// Get cargo
			$_type = 'timmars-' . $vehicle;
			$sth = $dbh->query ( "select * from farmen_cargo where type='{$_type}'" );
			$timmars = $sth->fetchObject ();
			
			// Get cargo
			$_type = 'panik-' . $vehicle;
			$sth = $dbh->query ( "select * from farmen_cargo where type='{$_type}'" );
			$panic = $sth->fetchObject ();
			
			// Get cargo
			$sth = $dbh->query ( "select * from farmen_cargo where type='{$type}'" );
			$cargo = $sth->fetchObject ();
			
			if ($matrix && $timmars && $cargo) {
				switch ($c = $urgency) {
					case 'samlastaren' :
						if ($matrix->type == 'green') {
							$result = round ( (($matrix->timmars + $timmars->a1) * $cargo->a58), 0 );
						} else {
							$result = round ( (($matrix->timmars + $timmars->a1) / $cargo->a1), 0 );
						}
						break;
					
					case 'budget' :
					case 'ekonomi' :
					case 'miljo' :
						if ($matrix->type == 'green') {
							$result = round ( (($matrix->timmars + $timmars->a1) * $cargo->a58), 0 );
						} else {
							$result = round ( (($matrix->timmars + $timmars->a1) * $cargo->a1), 0 );
						}
						break;
					
					case 'timmars' :
						if ($vehicle == '1-5') {
							$result = $matrix->low_timmars;
						} else {
							$result = round ( $matrix->timmars + $timmars->a1, 0 );
						}
						break;
					
					case 'panik' :
					case '2timmars' :
						if ($vehicle == '1-5' && $from < 4 & $to < 4) {
							$result = round ( ($matrix->low_timmars * 1.9), 0 );
						} else {
							if ($matrix->type == 'red' || (($vehicle != '1-5' && $vehicle != '6-50') && $matrix->type == 'green')) {
								$a = array (44, 45, 46, 49, 50, 52, 54 );
								if (($vehicle != '1-5' || $vehicle == '6-50') && $matrix->type == 'red' && (! in_array ( $from, $a ) && ! in_array ( $to, $a ))) {
									$result = round ( (270 + $matrix->timmars + $panic->a1), 0 );
								} else {
									$result = round ( ($matrix->panik + $matrix->timmars + $panic->a1), 0 );
								}
							} else if (($vehicle != '1-5' || $vehicle == '6-50') && $matrix->type == 'green' && (($from == 56 && $to == 56) || ($from == 55 && $to == 55))) {
								$result = 1000;
							} else {
								$result = round ( ($matrix->panik * ($matrix->timmars) + $panic->a1), 0 );
							}
						}
						
						if ($c == '2timmars') {
							if ($vehicle == '1-5' && $from < 4 & $to < 4) {
								$result = round ( (($result - $matrix->low_timmars) / 2 + $matrix->low_timmars), 0 );
							} else {
								$result = round ( (($result - $matrix->timmars - $timmars->a1) / 2 + $matrix->timmars + $timmars->a1), 0 );
							}
						}
						
						break;
					
					default :
						$result = '';
						break;
				}
			}
			
			$results [$z] ['urgency'] = $urgency;
			$results [$z] ['price'] = ! empty ( $result ) ? number_format ( $result, 0 ) : $result;
			$z ++;
		}
		
		echo json_encode ( $results );
	}
}
?>
