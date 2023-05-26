<?php
require "conexion.php";
 /*$servername = "localhost";
 $username = "root";
 $password = "";
 $database = "programa";
 // Create connection
 $conn = mysqli_connect($servername, $username, $password, $database);*/
 // Check connection
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 mysqli_set_charset($conn, "utf8");
$num = 0;

$sql = "SELECT n_cadena FROM reaccion
where n_cadena = ( select max(n_cadena)
from reaccion)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar el resultado de la consulta
    $row = $result->fetch_assoc();
    $n_cadena = $row["n_cadena"];
    $n_cadena +=1;
}
else{
    $n_cadena = 0;
}
$orden=1;


$ruta = "../uploads/otra_cargar.txt";
$contenido = file_get_contents($ruta);
$contenido_utf8 =   mb_convert_encoding($contenido, 'UTF-8', 'ISO-8859-1');

$archivo = fopen($ruta, "r");

$orden=1;
$revisa = 1;
 while (!feof($archivo)) {
   $linea = fgets($archivo);
   $linea = trim($linea);
   // hacer algo con la línea leída, por ejemplo, imprimirla
   $sql = "INSERT INTO reaccion (palabra, revisada, n_cadena, pos, ordre_secuencia) VALUES (UPPER('$linea'),$revisa,$n_cadena,1,$orden)";
        if (mysqli_query($conn, $sql)){
        $orden += 1;
        $num += 1;
        $revisa = 0;
        }
        else {
            echo "no insertados correctamente.".$linea . "<br>";
        }
 }
 fclose($archivo);
 unlink($ruta); // borrar el archivo


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">  
    <title>Carga</title>
    <body>
<?php
    echo $num . "cargadas";
?>
    <a href="../carga2.html">Tornar a pagina anterior</a>

</form>
    </body>
    

</html>