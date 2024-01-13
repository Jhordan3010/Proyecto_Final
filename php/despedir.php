<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/despedir.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Recursos humanos</title>
</head>
<body>
    <header>
        <h1>Despedir empleado</h1>
    </header>

    <main>
        <form action="" method="post">
            <section class="buscar-info">
                <label for="CI">Cédula Empleado</label>
                <input type="text" name="CI">
                <button type="submit" name="buscar">Buscar</button>
            </section>
        </form>

        <section class="section-borders">
            <label id="informacion-empleado" for="info-empleado"></label>
        </section>

        <form action="" method="post">
            <input type="hidden" name="CI" id="hiddenCI" value="">
            <!-- Puedes agregar campos adicionales si es necesario mostrar más información del empleado -->
            <button type="submit" id="despedir-button" name="despedir">Despedir</button>
        </form>
    </main>

    <footer>
    </footer>

<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CI = isset($_POST['CI']) ? $_POST['CI'] : '';

    if (isset($_POST['buscar'])) {
        $conn = conectar("midb_Proyecto");

        $sql = "SELECT * FROM persona WHERE CI='$CI'";
        $query = $conn->query($sql);

        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $informacion_empleado = '<label for="info-empleado">Información del Empleado</label>';
            $informacion_empleado .= '<p>Nombre: ' . $row['nombre'] . '</p>';
            $informacion_empleado .= '<p>Apellido: ' . $row['apellido'] . '</p>';
            $informacion_empleado .= '<p>Dirección: ' . $row['direccion'] . '</p>';
            $informacion_empleado .= '<p>Teléfono: ' . $row['telefono'] . '</p>';
            $informacion_empleado .= '<p>E-mail: ' . $row['email'] . '</p>';
            $informacion_empleado .= '<p>Cargo: ' . $row['cargo'] . '</p>';
            $informacion_empleado .= '<p>Sueldo: $' . $row['sueldo'] . '</p>';
            // Puedes añadir más campos según la estructura de tu base de datos

            // Asignar la información al label
            echo '<script>document.getElementById("informacion-empleado").innerHTML = \'' . $informacion_empleado . '\';</script>';
            
            // Actualizar el valor del campo oculto
            echo '<script>document.getElementById("hiddenCI").value = \'' . $CI . '\';</script>';
        } else {
            echo '<script>alert("No se encontró información para la cédula ingresada.");</script>';
        }

        $conn->close();
    } elseif (isset($_POST['despedir'])) {
        $conn = conectar("midb_Proyecto");

        $CI = isset($_POST['CI']) ? $_POST['CI'] : '';

        $sql_delete = "DELETE FROM persona WHERE CI='$CI'";
        //echo '<script>alert("SQL DELETE: ' . $sql_delete . '");</script>';

        if ($conn->query($sql_delete) === TRUE) {
            echo '<script>alert("Empleado despedido exitosamente!");</script>';
            // Puedes redirigir a una página específica después de despedir al empleado
            echo '<script>window.location.assign("../html/menu.html");</script>';
        } else {
            echo '<script>alert("Error al despedir: ' . $conn->error . '");</script>';
        }

        $conn->close();
    }
}
?>
</body>
</html>

