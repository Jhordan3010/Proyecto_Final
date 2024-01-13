<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/contratar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Recursos humanos</title>
</head>
<body>
    <header>
        <h1>Registrar nuevo empleado</h1>
    </header>

    <main>
    <form action="contratar.php" method="POST">
           <article class="formulario">
                    <div class="datos">
                        <label for="CI" >Cédula</label>
                        <label for="nombre">Nombre</label>
                        <label for="apellido">Apellido</label>
                        <label for="direccion">Dirección</label>
                        <label for="telefono">Teléfono</label>
                        <label for="email">E-mail</label>
                        <label for="cargo">Cargo</label>
                        <label for="sueldo">Sueldo</label>
                        
                    </div>
                    <div class="campos">
                        <input type="text" name="CI">
                        <input type="text" name="nombre">
                        <input type="text" name="apellido">
                        <input type="text" name="direccion">
                        <input type="text" name="telefono">
                        <input type="text" name="correo">
                        <input type="text" name="cargo">
                        <input type="text" name="sueldo">
    
                    </div>
    
                </article>
                <button id="registrar-button" type="submit" > Registrar</button>
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
                $CI = $_POST['CI'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];
                $cargo = $_POST['cargo'];
                $sueldo = $_POST['sueldo'];
        
                $conn = conectar("midb_Proyecto");
        
                $sql = "SELECT * FROM persona WHERE CI='$CI'";
                $query = $conn->query($sql);
        
                if ($query->num_rows > 0) {
                    $row = $query->fetch_assoc();
                    $CI = $row['CI'];
                    echo '<script>alert("Empleado ya registrado!");</script>';
                    echo '<script>window.location.assign("contratar.php");</script>';
                } else {
                    $sql = "INSERT INTO PERSONA (CI,nombre,apellido,direccion,telefono,email,cargo,sueldo)
                            VALUES ('$CI','$nombre', '$apellido', '$direccion','$telefono','$correo','$cargo','$sueldo')";
        
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("Registrado exitosamente!");</script>';
                        echo '<script>window.location.assign("../html/menu.html");</script>';
                    } else {
                        echo '<script>alert("Error: ' . $conn->error . '");</script>';
                        echo '<script>window.location.assign("contratar.php");</script>';
                    }
                }
        
                $conn->close();
            }
        ?>



    
</body>
</html>