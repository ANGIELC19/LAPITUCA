<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Pituca - Registrarse</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

        body {
            background-image: url('img/IMAG 1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: "Oswald", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #78787849;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.548);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn-register,
        .btn-google {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-register {
            background-color: #4CAF50;
            color: white;
            width: 100%;
        }

        .btn-google {
            background-color: #fff;
            color: #757575;
            border: 1px solid #ddd;
            width: 100%;
        }

        .btn-google img {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }

        .login-link {
            margin-top: 15px;
        }

        .login-link a {
            color: #0a027f;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .social-icons {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <a href="index.html" class="back-button">Regresar</a>
    <div class="container">
        <h1>REGÍSTRATE</h1>
        <p>¡Crea tu cuenta para empezar!</p>

        <form action="registrar-sesion.php" method="post">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input id="username" name="username" required type="text" placeholder="Introduce tu nombre de usuario" />
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" required type="email" placeholder="Introduce tu correo electrónico" />
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" name="password" required type="password" placeholder="••••••••••" />
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirmar contraseña</label>
                <input id="confirm-password" name="confirm-password" required type="password" placeholder="••••••••••" />
            </div>

            <button class="btn-register" type="submit">Registrarse</button>
        </form>

        <!-- php para poder registrar -->
        <?php
        error_reporting(0);

        // Configuración de la conexión
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lapitucadb";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Recibir datos del formulario
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $confirm_pass = $_POST['confirm-password'];

        // Validar que las contraseñas coincidan
        if ($pass !== $confirm_pass) {
            die("Las contraseñas no coinciden.");
        }

        // Preparar y ejecutar la consulta para insertar los datos
        $sql = "INSERT INTO usuarios ( `nombre_usuario`, `correo_electronico`, `contrasena`) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
     

        $stmt->bind_param("sss", $user, $email, $pass);

        if ($stmt->execute()) {
            echo "<script>¡Registro exitoso!</script>";
        } else {
            echo "<script>Error: " . $stmt->error."</script>";
        }

       
        ?>



        <p class="login-link">¿Ya tienes una cuenta? <a href="inicio-sesion.html">Inicia sesión</a></p>
    </div>
    </div>
</body>

</html>