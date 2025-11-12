<?php
$dbhost = "localhost"; // Servidor
$dbuser = "root"; // Nombre de usuario
$dbpass = "marco"; // Contraseña
$dbname = "megusta"; // Nombre de la base de datos

# Creamos conexion a la base de datos
$link = mysql_connect($dbhost,$dbuser,$dbpass);
		mysql_select_db($dbname,$link);

    // SEPARAR LINEAS SUPERIORES EN PHP INDEPENDIENTE!!!

# Imprimimos una prueba para dar como ejemplo
$sql = "SELECT * FROM post ORDER BY megusta DESC";
$query = mysql_query($sql,$link);
?>
<table width="800" border="0" align="center">
  <tr>
    <td width="5%" align="center">ID</td>
    <td width="63%" align="center">NOMBRE DEL POST</td>
    <td width="32%" align="center">ME GUSTA</td>
  </tr>
<?php
while($row = mysql_fetch_assoc($query))
{?>
  <tr>
    <td width="5%" align="center"><?=$row['id']?></td>
    <td width="63%" align="center"><?=$row['nombre']?></td>
    <td width="32%" align="center">[<a href="megusta.php?voto=positivo&id=<?=$row['id']?>">Me gusta</a>] <?=$row['megusta']?> [<a href="megusta.php?voto=negativo&id=<?=$row['id']?>">No me gusta</a>]</td>
  </tr>
<?php	
}	
?>
</table>