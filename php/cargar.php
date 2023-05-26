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
$num = 0;
$ruta = "../uploads/palabras_cargar.txt";
$contenido = file_get_contents($ruta);
$contenido_utf8 =   mb_convert_encoding($contenido, 'UTF-8', 'ISO-8859-1');

 $archivo = fopen($ruta, "r");
 while (!feof($archivo)) {
   $linea = fgets($archivo);
   $linea = trim($linea);
   // hacer algo con la línea leída, por ejemplo, imprimirla
   $sql = "INSERT INTO palabras (nombre, contador) VALUES (UPPER('$linea'),0)";
        if (mysqli_query($conn, $sql)){
        $num += 1;
        }
        else {
            echo "no insertados correctamente.".$linea . "<br>";
        }
 }
 fclose($archivo);
 unlink($ruta); // borrar el archivo


?>
<!--
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">  
    <title>Carga</title>
    <body>
php
    echo $num . "cargadas";
?>

</form>
    </body>
    

</html>
-->