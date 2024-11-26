<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "root"; // Tu usuario de MySQL
$password = ""; // Tu contraseña de MySQL
$database = "PreciosDB"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Habilitar el uso de UTF-8
$conn->set_charset("utf8");



// Consultar los datos de Impresiones
$queryImpresiones = "SELECT * FROM impresiones";
$resultImpresiones = $conn->query($queryImpresiones);

// Consultar los datos de Fotocopias
$queryFotocopias = "SELECT * FROM fotocopias";
$resultFotocopias = $conn->query($queryFotocopias);

// Crear un arreglo para almacenar los datos
$data = [
    "impresiones" => [],
    "fotocopias" => []
];

// Procesar los datos de Impresiones
if ($resultImpresiones->num_rows > 0) {
    while ($row = $resultImpresiones->fetch_assoc()) {
        $data["impresiones"][] = $row;
    }
}

// Procesar los datos de Fotocopias
if ($resultFotocopias->num_rows > 0) {
    while ($row = $resultFotocopias->fetch_assoc()) {
        $data["fotocopias"][] = $row;
    }
}

// Responder con datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>
