<?php
include('conexion.php');
$titulo = strtoupper(trim($_POST['titulo']));
$contenido = addslashes(trim($_POST['contenido']));
$sql = "INSERT INTO lenguajes_contenido (lenguaje_id, titulo, contenido) VALUES ({$_POST['opciones']},'$titulo', '$contenido')";
if ($mysqli->query($sql)  === TRUE ) {
	echo 'Guardado Exitosamente';
} else {
	echo 'Error Intentelo Nuevamente, '.$mysqli->error;	
}
$mysqli->close();
//header('location:index.php');
?>
