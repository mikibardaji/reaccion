<?php
require "conexion.php";
/*$servername = "localhost";
$database = "id19843219_concurso";
$username = "id19843219_concurso";
$password = "Concurso12.";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);*/
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn, "utf8");
$sql = "SELECT nombre FROM palabras ORDER BY RAND() LIMIT 1";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row['nombre'];
    $nombre = strtolower($nombre);
} else {
    $nombre = "No se encontraron nombres";
}

echo "<h1 style='font-size: 200px;'> " . $nombre . "</h1>";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">  
    <title>CAM</title>
    <body>


</form>
    </body>
    

</html>