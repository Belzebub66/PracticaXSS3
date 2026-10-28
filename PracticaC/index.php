<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio: DOM XSS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .mensaje-box { padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <div class="mensaje-box" id="saludo">Cargando saludo...</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. SOURCE: Se lee el fragmento de la URL (después del carácter '#')
            let hash = window.location.hash.substring(1); 
            
            if (hash) {
                let nombreUsuario = decodeURIComponent(hash);
                // Solución segura
                document.getElementById('saludo').textContent = "Bienvenido, " + nombreUsuario + "!";   
                //solución que no es segura
                //document.getElementById('saludo').innerHTML = "Bienvenido, " + nombreUsuario + "!";
            } else {
                document.getElementById('saludo').innerHTML = "Bienvenido, invitado!";
            }
        });

        // Escuchar cambios en el hash sin recargar
        window.addEventListener("hashchange", function() {
            let hash = window.location.hash.substring(1);
            if (hash) {
                document.getElementById('saludo').innerHTML = "Bienvenido, " + decodeURIComponent(hash) + "!";
            }
        });
    </script>
</body>
</html>