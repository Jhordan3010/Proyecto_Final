<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../css/editar.css">
</head>
<body>
    <h1>Editar Empleado</h1>

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

    if (isset($_GET['CI'])) {
        $CI = $_GET['CI'];
        $conn = conectar("midb_Proyecto");
        $sql = "SELECT * FROM persona WHERE CI='$CI'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            echo "<form action='actualizar.php' method='post'>";
            echo "Cédula: <input type='text' name='CI' value='" . $fila['CI'] . "' readonly><br>";
            echo "Nombre: <input type='text' name='nombre' value='" . $fila['nombre'] . "'><br>";
            echo "Apellido: <input type='text' name='apellido' value='" . $fila['apellido'] . "'><br>";
            echo "Dirección: <input type='text' name='direccion' value='" . $fila['direccion'] . "'><br>";
            echo "Teléfono: <input type='text' name='telefono' value='" . $fila['telefono'] . "'><br>";
            echo "Email: <input type='text' name='email' value='" . $fila['email'] . "'><br>";
            echo "Cargo: <input type='text' name='cargo' value='" . $fila['cargo'] . "'><br>";
            echo "Sueldo: <input type='text' name='sueldo' value='" . $fila['sueldo'] . "'><br>";
            echo "<input type='submit' value='Actualizar'>";
            echo "</form>";
        } else {
            echo "Empleado no encontrado.";
        }

        $conn->close();
    } else {
        echo "Cédula no proporcionada.";
    }
    ?>

    <button onclick="goBack()">Regresar</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
