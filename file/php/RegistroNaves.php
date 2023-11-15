<?php
$servername = "localhost";
$username = "id21214233_abraham";
$password = "Abraham#15";
$dbname = "id21214233_spacelogitics";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$nombreRepresentante = $_POST['Representante'];
$distancia = $_POST['Distancia'];
$combustible = $_POST['Combustible'];
$correo = $_POST['Correo'];
$contrasena = password_hash($_POST['Pass'], PASSWORD_DEFAULT);
$imagenNombre = $_FILES['Imagen']['name'];
$imagenTemporal = $_FILES['Imagen']['tmp_name'];
$directorioImagenes = __DIR__ . "/file/imagenes/img-bd/";
    mkdir($directorioImagenes, 0777, true);
    chmod($directorioImagenes, 0777);
}
$rutaImagenCompleta = $directorioImagenes . $imagenNombre;

if (move_uploaded_file($imagenTemporal, $rutaImagenCompleta)) {
    chmod($rutaImagenCompleta, 0777);
    $sql = "INSERT INTO naves (NombreRepresentante, Distancia, Combustible, Imagen, correo, contrasena) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiiss", $nombreRepresentante, $distancia, $combustible, $rutaImagenCompleta, $correo, $contrasena);
    if ($stmt->execute()) {
        echo '<script>';
        echo 'alert("Registro exitoso. Ahora puedes iniciar sesión y ver el estado de tu nave.");';
        echo 'window.location.replace("http://localhost/examen%20tecnico/");';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Registro fallido");';
        echo 'window.location.replace("http://localhost/examen%20tecnico/");';
        echo '</script>';
    }
    $stmt->close();
} else {
    echo '<script>';
    echo 'alert("Error al mover la imagen");';
    echo 'window.location.replace("http://localhost/examen%20tecnico/");';
    echo '</script>';
}

$conn->close();
?>
