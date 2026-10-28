<?php
include 'conexion.php';

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $comentario = $conexion->real_escape_string($_POST['comentario']);

    $sql = "INSERT INTO comentarios (nombre, comentario) VALUES ('$nombre', '$comentario')";
    if ($conexion->query($sql) === TRUE) {
        header("Refresh:0"); // Recargar la página para ver el comentario
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica B - XSS Almacenado</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { max-width: 600px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .comentario-box { background: #e9ecef; padding: 10px; margin-top: 10px; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Práctica B: Muro de Comentarios (XSS Almacenado)</h2>
    
    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        
        <label>Comentario:</label>
        <textarea name="comentario" rows="4" required></textarea>
        
        <button type="submit">Publicar Comentario</button>
    </form>

    <hr>

    <h3>Comentarios Recientes:</h3>
    <?php
    $resultado = $conexion->query("SELECT nombre, comentario, fecha FROM comentarios ORDER BY id DESC");
    
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            echo "<div class='comentario-box'>";
            echo "<strong>" . $fila['nombre'] . "</strong> <em>(" . $fila['fecha'] . ")</em><br>";
            // VULNERABILIDAD INTENCIONAL DE XSS ALMACENADO:
            echo "<p>" . $fila['comentario'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay comentarios aún. ¡Sé el primero en comentar!</p>";
    }
    $conexion->close();
    ?>
</div>

</body>
</html>