<!DOCTYPE html>
<html>
<head>
    <title>Consulta de palabras</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Consulta de palabras</h1>
    <form method="post">
        <button type="submit" name="consulta" value="1">Consultar Palabra 1</button>
        <button type="submit" name="consulta" value="2">Consultar Palabra 2</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Palabra</th>
        </tr>
        <?php
        // Verificar si se envió el formulario
        if (isset($_POST['consulta'])) {
            // Obtener el valor del botón presionado
            $consulta = $_POST['consulta'];

            // Conectarse a la base de datos
            $servername = "localhost";
            $username = "tu_usuario";
            $password = "tu_contraseña";
            $database = "tu_base_de_datos";
            $conn = new mysqli($servername, $username, $password, $database);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consultar la base de datos
            $sql = "SELECT id, paraula FROM cadena WHERE id = $consulta";
            $result = $conn->query($sql);

            // Mostrar los resultados en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['paraula'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
            }

            // Realizar otra consulta
            $otraConsulta = $consulta == 1 ? 2 : 1;
            $sql = "SELECT id, paraula FROM cadena WHERE id = $otraConsulta";
            $result = $conn->query($sql);

            // Mostrar los resultados en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['paraula'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
        }
        ?>
    </table>
</body>
</html>
