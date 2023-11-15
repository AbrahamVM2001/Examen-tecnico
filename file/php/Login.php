<?php
session_start();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "id21214233_abraham";
    $password = "Abraham#15";
    $dbname = "id21214233_spacelogitics";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $stmt = $conn->prepare("SELECT ClaveNave, contrasena FROM naves WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($claveNave, $contrasenaAlmacenada);
    $stmt->fetch();
    $stmt->close();
    if ($contrasenaAlmacenada && password_verify($contrasena, $contrasenaAlmacenada)) {
        $_SESSION['claveNave'] = $claveNave;
        header("Location: http://localhost/examen%20tecnico/CPanel.html"); 
        exit();
    } else {
        echo '<script>';
        echo 'alert("Correo o contraseña incorrecto, redirigiendo a la pantalla incial");';
        echo 'window.location.replace("http://localhost/examen%20tecnico/");';
        echo '</script>';
    }
    $conn->close();
}
?>
