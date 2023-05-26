<?php
function palabraAleatoria(){
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
    $sql = "SELECT nombre FROM palabras
    where contador = (select min(contador) from palabras) ORDER BY RAND() LIMIT 1";
    $resultado = mysqli_query($conn, $sql);
    //echo "hola";
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $nombre = $row['nombre'];
        
        $sqlUpdate = "UPDATE palabras 
        SET contador = contador + 1 
        WHERE nombre = '$nombre'";
      //echo "vinagre";
      if (mysqli_query($conn, $sqlUpdate)) {
        //echo "Actualización realizada con éxito";
        } 
      else{
        $nombre = "No update";
      }
     $nombre = strtoupper($nombre);

  } else {
      $nombre = "No se encontraron nombres";
  }
  
  return $nombre;

}
  
// Verificar si se recibió una solicitud para obtener una palabra aleatoria
if (isset($_GET["accion"]) && $_GET["accion"] == "palabraAleatoria") {
    // Obtener una palabra aleatoria y retornarla como una respuesta JSON
    $palabra = palabraAleatoria();
    echo json_encode(array("palabra" => $palabra));
  }
?>