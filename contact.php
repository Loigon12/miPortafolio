<?php
// contact.php - Archivo para manejar el envío del formulario

// Configuración de la conexión a la base de datos
$host = "localhost"; // Host de la base de datos
$usuario = "root"; // Usuario de la base de datos
$contrasena = ""; // Contraseña del usuario
$base_datos = "portfolio_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y validar entradas
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $mensaje = $conn->real_escape_string($_POST['mensaje']);
    
    // Validación básica
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no válido");
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO contactos (nombre, email, mensaje)
    VALUES ('$nombre', '$email', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        echo "Mensaje guardado exitosamente";
        // Puedes redirigir a una página de éxito o mostrar un mensaje
        header("Location: gracias.html");
    } else {
        echo "Error al guardar el mensaje: " . $conn->error;
    }
}

// contact.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn->close();
?>