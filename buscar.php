<?php
// Práctica A: XSS Reflejado en PHP
$termino = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica A - XSS Reflejado</title>
</head>
<body>
    <h1>Práctica A: XSS Reflejado en PHP</h1>
    
    <form method="GET" action="buscar.php">
        <label for="busqueda">Buscar término:</label>
        <input type="text" name="busqueda" id="busqueda" value="<?php echo htmlspecialchars($termino, ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit">Buscar</button>
    </form>

    <hr>

    <h3>Resultado de la búsqueda:</h3>
    <div style="background: #f4f4f4; padding: 10px; border: 1px solid #ddd;">
        <?php
        if (!empty($termino)) {
            // ==========================================
            // 1. VERSIÓN VULNERABLE
            //echo "Buscaste: " . $termino;

            // ==========================================
            // 2. VERSIÓN SEGURA
            echo "Buscaste: " . htmlspecialchars($termino, ENT_QUOTES, 'UTF-8');
        }
        ?>
    </div>
</body>
</html>