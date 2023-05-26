<?php
    $servername = "localhost";
    $database = "concurso";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8");
    $nombre = 'Abejorro';
    $sqlUpdate = "UPDATE palabras 
      SET contador = contador + 1 
      WHERE nombre = '$nombre'";
      if (mysqli_query($conn, $sqlUpdate)) {
        echo "Actualización realizada con éxito";
        $html = "<!DOCTYPE html>
             <html>
             <head>
                 <meta charset='UTF-8'>
                 <title>OK</title>
             </head>
             <body>
                 <h1>OK</h1>
             </body>
             </html>";
        file_put_contents("ok.html", $html);
        }
      else{
        echo "Actualización FALADA";
        $html = "<!DOCTYPE html>
             <html>
             <head>
                 <meta charset='UTF-8'>
                 <title>OK</title>
             </head>
             <body>
                 <h1>no ha ido</h1>
             </body>
             </html>";
    file_put_contents("ko.html", $html);
      } 


?>

