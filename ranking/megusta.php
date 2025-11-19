<?php
$dbhost = "localhost"; // Servidor
$dbuser = "root"; // Nombre de usuario
$dbpass = "MiNuevaClave*__*ññ5559903"; // Contraseña
$dbname = "ranking"; // Nombre de la base de datos

# Creamos conexion a la base de datos
$link = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $link);

# Saber si el voto es negativo o positivo
$voto = htmlentities($_GET['voto']);

# Tomamos el id de nuestro post y vemos todas las ip que pusieron megusta
$id = (int) $_GET['id'];
$query = mysql_query("SELECT id,ips FROM post WHERE id='" . $id . "'", $link);
$row = mysql_fetch_assoc($query);
$ip = $row['ips'];

# Obtenemos la ip de nuestro visitante		
if ($HTTP_X_FORWARDED_FOR == "") {
	$ipp = getenv(REMOTE_ADDR);
} else {
	$ipp = getenv(HTTP_X_FORWARDED_FOR);
}

# Me gusta o No me gusta
switch ($voto) {
	case "positivo";
		if ($query) {
			$var = explode(",", $ip);
			$arr = in_array($ipp, $var);
			if (!$arr) {
				mysql_query("UPDATE post SET megusta=megusta+1, ips=CONCAT(post.ips,'" . $ipp . ",') WHERE id='" . $id . "'", $link);
			}
		}
		break;
	case "negativo";
		if ($query) {
			$var = explode(",", $ip);
			$arr = in_array($ipp, $var);
			if (!$arr) {
				mysql_query("UPDATE post SET megusta=megusta-1, ips=CONCAT(post.ips,'" . $ipp . ",') WHERE id='" . $id . "'", $link);
			}
		}
		break;
}
header('location:index.php');
