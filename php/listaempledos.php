<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../css/empleados.css">
</head>
<body>
    <h1>Lista de Empleados</h1>

    <?php
    function conectar($dbname) {
        $servername = 'localhost';
        $username = 'Jhordan';
        $password = '123456789';
        $port = 3306;

        $conn = new mysqli($servername, $username, $password, $dbname, $port);

        if ($conn->connect_error) {
            die("Conexión a base de datos falló: " . $conn->connect_error);
        }

        return $conn;
    }

    $conn = conectar("midb_Proyecto");

    $sql = "SELECT * FROM persona";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Sueldo</th>
                <th>Acciones</th>
              </tr>";

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['CI'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellido'] . "</td>";
            echo "<td>" . $fila['direccion'] . "</td>";
            echo "<td>" . $fila['telefono'] . "</td>";
            echo "<td>" . $fila['email'] . "</td>";
            echo "<td>" . $fila['cargo'] . "</td>";
            echo "<td>" . $fila['sueldo'] . "</td>";
            echo "<td><a href='editar.php?CI=" . $fila['CI'] . "'>Editar</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron empleados.";
    }

    $conn->close();
    ?>

    <button onclick="goBack()">Regresar</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

