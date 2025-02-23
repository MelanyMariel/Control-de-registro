<?php
include 'Bd_registro.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$fecha = $_POST['fecha'];
$telefono = $_POST['telefono'];
$entidad = $_POST['entidad'];
$tipoatencion = $_POST['tipoatencion'];
$otro = $_POST['otro'];


if ($tipoatencion !== 'Otro') {
    $otro = '-' . $otro; 
}


$stmt = $conn->prepare("INSERT INTO controlatencion (Nombre, Apellido, Cedula, Fecha, Telefono, Entidad, Tipoatencion, Detalleatencion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nombre, $apellido, $cedula, $fecha, $telefono, $entidad, $tipoatencion,$otro);

$response = "";
if ($stmt->execute()) {
    $response = "TRUE";
} else {
    $response = "Error: " . $stmt->error; 
}

$stmt->close();
$conn->close();

echo $response;

?>
