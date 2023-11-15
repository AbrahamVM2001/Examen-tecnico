<?php
$servername = "localhost";
$username = "id21214233_abraham";
$password = "Abraham#15";
$dbname = "id21214233_spacelogitics";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$nombreCompleto = $_POST['NomCom'];
$numeroCelular = $_POST['celular'];
$peso = $_POST['Peso'];
$planetaEnvio = $_POST['inputState'];
$planetaDestino = $_POST['inputStates'];
$sqlBuscarNave = "SELECT ClaveNave, Combustible FROM naves WHERE Distancia >= (SELECT Distancia FROM planetas WHERE NombrePlaneta = '$planetaDestino') ORDER BY Combustible DESC LIMIT 1";
$resultBuscarNave = $conn->query($sqlBuscarNave);

if ($resultBuscarNave->num_rows > 0) {
    $rowNave = $resultBuscarNave->fetch_assoc();
    $claveNave = $rowNave['ClaveNave'];
    $combustibleNave = $rowNave['Combustible'];
    $distanciaPlaneta = obtenerDistanciaEntrePlanetas($planetaEnvio, $planetaDestino);
    
    if ($combustibleNave >= $distanciaPlaneta) {
        $sqlInsertarEnvio = "INSERT INTO envios (IdPlaneta, ClaveNave, NombreCompleto, NumeroCelular, Peso, PlanetaEnvio, PlanetaDestino, Distancia, Estado) VALUES ((SELECT IdPlaneta FROM planetas WHERE NombrePlaneta = '$planetaEnvio'), '$claveNave', '$nombreCompleto', '$numeroCelular', '$peso', '$planetaEnvio', '$planetaDestino', '$distanciaPlaneta', 'En espera')";
        if ($conn->query($sqlInsertarEnvio) === TRUE) {
            echo "Envío almacenado correctamente";
        } else {
            echo "Error al almacenar el envío: " . $conn->error;
        }
    } else {
        echo "La nave necesita recargar combustible";
    }
} else {
    echo "No hay naves disponibles para esa distancia";
}
function obtenerDistanciaEntrePlanetas($planetaEnvio, $planetaDestino) {
    return 0;
}
$conn->close();
?>
