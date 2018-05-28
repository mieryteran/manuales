<?php
$mysqli = new mysqli('localhost','root','','manuales');
if ($mysqli->connect_error) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
 }
function pr($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
//$mysqli->autocommit(FALSE);

?>