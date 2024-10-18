<?php
// Obtener los datos del formulario
$nombres = $_POST['nombres'];
$incidencia = $_POST['incidencia'];
$descripcion = $_POST['descripcion'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Obtener el archivo de imagen
$foto = $_FILES['foto'];

// Directorio donde se guardará la imagen
$directorio = './fotos/';

// Nombre único para la imagen (puedes usar algún método para generar un nombre único)
$nombreImagen = uniqid() . '_' . $foto['name'];

// Ruta completa de la imagen
$rutaImagen = $directorio . $nombreImagen;
// Mover la imagen al directorio
if (move_uploaded_file($foto['tmp_name'], $rutaImagen)) {
  // Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
  $host = 'localhost';
  $usuario = 'root';
  $contrasena = 'root';
  $baseDatos = 'osm_project';

  $conexion = new mysqli($host, $usuario, $contrasena, $baseDatos);

  // Verificar la conexión
  if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
  }

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO tabla_incidencias (nombres, incidencia, descripcion, foto, latitude, longitude) VALUES ('$nombres', '$incidencia', '$descripcion', '$rutaImagen', '$latitude', '$longitude')";

  if ($conexion->query($sql) === TRUE) {
    echo 'Incidencia registrada correctamente';
  } else {
    echo 'Error al registrar la incidencia: ' . $conexion->error;
  }

  // Cerrar la conexión
  $conexion->close();
} else {
  echo 'Error al subir la imagen';
}
?>
