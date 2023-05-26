<?php
$target_dir = "../uploads/"; // Directorio donde se guarda el archivo
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Ruta completa del archivo
$uploadOk = 1; // Variable que indica si se puede subir el archivo o no

// Comprobar si el archivo ya existe
if (file_exists($target_file)) {
  echo "Lo siento, el archivo ya existe.";
  $uploadOk = 0;
}

// Comprobar el tamaño máximo del archivo
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Lo siento, el archivo es demasiado grande.";
  $uploadOk = 0;
}

// Permitir sólo ciertos formatos de archivo
$allowed_extensions = array("txt","php","js");
$file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (!in_array($file_extension, $allowed_extensions)) {
  echo "Lo siento, sólo se permiten archivos txt, php, js y CSS.";
  $uploadOk = 0;
}

// Comprobar si $uploadOk está establecido en 0 por un error
if ($uploadOk == 0) {
  echo "Lo siento, el archivo no fue subido.";
// Si todo está bien, intenta subir el archivo
} else {

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "El archivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " ha sido subido.";
    //canvia el nom del fitxer a palabras_cargar
    $target_new_name = $target_dir . "otra_cargar.txt";
    rename($target_file, $target_new_name);
  } else {
    echo $target_file;
    echo "Lo siento, ha habido un error al subir el archivo.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cuenta regresiva</title>
</head>
<body>
  <h1><a href="../carga2.html">Volver</a></h1>
  
</body>
</html>