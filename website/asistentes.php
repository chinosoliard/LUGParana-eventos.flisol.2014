<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);	
	include 'conexion.php';
	$dbconection = mysqli_connect($db_host,$db_user,$db_pass,$db_db);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$query = 'SELECT * FROM attendees';
?>
<head>
        <title>FLISOL 2014 - Lista de pre-acreditados</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/960_16_col.css">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h3>Lista de pre-acreditados - FLISOL 2014</h3>
<table border="1">
  <tr>
    <th>DNI</th>
    <th>APELLIDO</th>
    <th>NOMBRE</th>
    <th>INSTALA</th>
    <th>FECHA DE REGISTRO</th>
  </tr>
<?php
	if ($result = mysqli_query($dbconection, $query)) {	
	$numero = 0;
	$instalasl = 0;
	/* fetch associative array */
	    while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>{$row['DNI']}</td><td>{$row['apellido']}</td><td>{$row['nombre']}</td><td>{$row['instala']}</td>
		<td>{$row['fechareg']}</td></tr>";
		$numero++;
		if ($row['instala'] == 1){
			$instalasl++;
		}
	}
	    /* free result set */
	    mysqli_free_result($result);
	}	
?>
</table> 
<?php	
	echo "<h2>Total: $numero</h2>";
	echo "<h2>Instalaciones: $instalasl</h2>";
	/* close connection */
	mysqli_close($dbconection);
?>

</body>
</html>
