<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica M06 UF1</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="apple-touch-icon" sizes="180x180" href="logos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="logos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="logos/favicon-16x16.png">
</head>
<body>

<div class="main-container" style="display: flex; flex-direction: row; gap: 20px;">

    <!-- Sección unificada de comandos para Directorios y Archivos -->
    <div class="console-container" style="flex: 1;">
        <h1>Consola Sistema de Archivo</h1>
        
        <!-- Formulario único -->
        <form action="projectController.php" method="POST">
            <!-- Campo oculto para almacenar el comando -->
            <input type="hidden" name="command" id="commandInput" value="">

            <!-- Sección de entrada de parámetros -->
            <div class="param-section">
                <label for="paramInput">Introduce los parámetros aquí:</label>
                <input type="text" name="param" id="paramInput" placeholder="Introduce nombre de archivo o rutas aquí...">
            </div>

            <!-- Botones para Comandos de Directorios y Archivos -->
            <div style="margin-top: 20px;">
                
                <div class="command-buttons" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                    <!-- Comandos para Directorios -->
                    <button type="submit" name="command" value="createDirectory">Crear Directorio</button>
                    <button type="submit" name="command" value="deleteDirectory">Borrar Directorio</button>
                    <button type="submit" name="command" value="moveDirectory">Mover Directorio</button>
                    <button type="submit" name="command" value="copyDirectory">Copiar Directorio</button>
                    
                    <!-- Comandos para Archivos -->
                    <button type="submit" name="command" value="searchFile">Buscar Archivo</button>
                    <button type="submit" name="command" value="getFileStatus">Estado del Archivo</button>
                    <button type="submit" name="command" value="deleteFile">Eliminar Archivo</button>
                    <button type="submit" name="command" value="moveFile">Mover Archivo</button>
                    <button type="submit" name="command" value="copyFile">Copiar Archivo</button>
                    <button type="submit" name="command" value="saveFile">Guardar Archivo</button>
                </div>
            </div>

            <!-- Instrucciones para Directorios y Archivos -->
            <div style="margin-top: 20px;">
                <h3>Manual de Comandos para Directorios y Archivos</h3>
                <ul style="list-style-type: none; padding: 0;">
                    <li><strong>📁 Crear Directorio:</strong> Crea un nuevo directorio. <em>(Requiere parámetro [nombre del directorio])</em></li>
                    <li><strong>🗑️ Borrar Directorio:</strong> Elimina el directorio especificado. <em>(Requiere parámetro [nombre del directorio])</em></li>
                    <li><strong>➡️ Mover Directorio:</strong> Mueve un directorio de una ubicación a otra. <em>(Requiere dos parámetros [ruta,rutadestino])</em></li>
                    <li><strong>📂 Copiar Directorio:</strong> Copia un directorio a una nueva ubicación. <em>(Requiere dos parámetros [ruta,rutadestino])</em></li>
                    <li><strong>🔍 Buscar Archivo:</strong> Verifica si un archivo existe en el sistema. <em>(Requiere parámetro [nombre del archivo.extension])</em></li>
                    <li><strong>📄 Obtener Estado del Archivo:</strong> Obtiene el tamaño y fecha de modificación del archivo. <em>(Requiere parámetro [nombre del archivo.extension])</em></li>
                    <li><strong>🗑️ Eliminar Archivo:</strong> Elimina el archivo especificado. <em>(Requiere parámetro [nombre del archivo.extension])</em></li>
                    <li><strong>➡️ Mover Archivo:</strong> Mueve un archivo de una ubicación a otra. <em>(Requiere dos parámetros [ruta,rutadestino])</em></li>
                    <li><strong>📂 Copiar Archivo:</strong> Copia un archivo de una ubicación a otra. <em>(Requiere dos parámetros [ruta,rutadestino])</em></li>
                    <li><strong>💾 Guardar Archivo:</strong> Guarda el contenido en un archivo. Si el archivo no existe, lo crea. <em>(Requiere dos parámetros [nombre del archivo,nuevo contenido])</em></li>
                </ul>
            </div>
        </form>
    </div>

    <!-- Sección de comandos para el Sistema -->
    <div class="console-container" style="flex: 1; max-width: 600px; padding: 15px; max-height: 500px; margin-top: 200px;">

        <h1>Comandos del Sistema</h1>
        <!-- Campo oculto para comandos del sistema -->
        <form action="projectController.php" method="POST">
            <input type="hidden" name="command" id="systemCommandInput" value="">
            <div class="command-buttons" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                <button type="submit" name="command" value="ls-d">Listar rutas del sistema</button>
                <button type="submit" name="command" value="df">Estado del Sistema</button>
                <button type="submit" name="command" value="pwd">Ruta Actual del Sistema</button>
            </div>
        </form>

    <!-- Instrucciones para comandos del Sistema -->
        <div style="margin-top: 60px;">
            <h3>Manual de Comandos del Sistema</h3>
            <ul style="list-style-type: none; padding: 0; font-size: 14px;">
                <li><strong>📂 Listar Rutas del Sistema:</strong> Muestra las rutas comunes del sistema</li>
                <li><strong>💻 Estado del Sistema de Archivos:</strong> Muestra información del sistema de archivos.</li>
                <li><strong>📍 Obtener Ruta Actual:</strong> Devuelve la ruta actual del sistema de archivos.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; Javier Cerejido Cortés 2024</p>
</footer>

</body>
</html>
