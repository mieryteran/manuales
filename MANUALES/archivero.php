<?php
header("Content-Type: text/html;charset=utf-8");
include('conexion.php');
$html = '';
$sql = $mysqli->query("SELECT * FROM lenguajes_contenido WHERE lenguaje_id = {$_REQUEST['id']} ORDER BY titulo");
if ( $sql->num_rows > 0 ) {
	$html .= "<pre>
	         <table>
	           <tr>
	            <th>TITULO</th>
	            <td>CONTENIDO</td>
	           </tr>";
  while ( $row = $sql->fetch_assoc() ) {
  	$titulo = htmlentities($row['titulo'], ENT_QUOTES);
  	$str = htmlentities($row['contenido'], ENT_QUOTES);
	$html .= "<tr>
	           <th>{$titulo}</th>
	           <td>{$str}</td>
	        </tr>";
  }
}
$html .= '</table></pre>';
echo $html;
?>