<?php
$servername = "localhost";
$username = "id21214233_abraham";
$password = "Abraham#15";
$dbname = "id21214233_spacelogitics";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$clavePlaneta = $_GET['clave'];
if (empty($clavePlaneta)) {
    $sql = "SELECT * FROM planetas";
} else {
    $sql = "SELECT * FROM planetas WHERE IdPlaneta = '$clavePlaneta'";
}

$result = $conn->query($sql);
$planetas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $planetas[] = $row;
    }
}

echo json_encode($planetas);
$conn->close();
?>
