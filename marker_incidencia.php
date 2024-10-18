<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "osm_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta SQL para obtener las coordenadas
$sql = "SELECT id, nombres, incidencia, descripcion, foto, latitude, longitude FROM tabla_incidencias";
$result = $conn->query($sql);

$coordinates = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Agregar cada conjunto de coordenadas al arreglo
        $coordinates[] = array(
            'id' => $row['id'],
            'nombres' => $row['nombres'],
            'incidencia' => $row['incidencia'],
            'descripcion' => $row['descripcion'],
            'foto' => $row['foto'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
        );
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver las coordenadas como una respuesta JSON
header('Content-Type: application/json');
echo json_encode($coordinates);
?>
