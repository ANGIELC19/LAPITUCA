<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "LaPitucaDB"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Preparar y bindear
$stmt = $conn->prepare("INSERT INTO reservaciones (nombre_completo, correo_electronico, numero_telefono, fecha_reserva, hora_reserva, numero_personas) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $nombre_completo, $correo_electronico, $numero_telefono, $fecha_reserva, $hora_reserva, $numero_personas);

// Setear parámetros y ejecutar
$nombre_completo = $_POST['name'];
$correo_electronico = $_POST['email'];
$numero_telefono = $_POST['phone'];
$fecha_reserva = $_POST['date'];
$hora_reserva = $_POST['time'];
$numero_personas = $_POST['guests'];

if ($stmt->execute()) {
    header("Location: enviar-reserva.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
