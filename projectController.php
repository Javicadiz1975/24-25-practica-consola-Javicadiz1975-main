<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica M06 UF1</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="apple-touch-icon" sizes="180x180" href="logos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="logos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="logos/favicon-16x16.png">
   
   
<body>
    <?php
    //ruta al archivo que contiene esta clase
    require 'clases/DirectoryManager.php';
    require 'clases/FileManager.php';      
    require 'clases/SystemManager.php';   
    require 'funciones/funciones.inc.php';

    // Crear instancias de las clases
    $directoryManager = new DirectoryManager();
    $fileManager = new FileManager();
    $systemManager = new SystemManager(); // Instancia para manejar rutas y sistema
    $boton = "<div class='center-button'>
                <a href='index.php' class='btn-main'>Volver al Main</a>
              </div>";

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $command = $_POST['command'] ?? '';
        $param = $_POST['param'] ?? '';
    
        if (!empty($param) && !validarParametro($param)) {
            echo salidaInvalida('Error de validación', 'El parámetro contiene caracteres no permitidos.');
            exit;
        }
        
        
        switch ($command) {
            case 'pwd':
                // El comando 'pwd' no necesita parámetros
                $output = salidaCorrecta('Ruta', "La ruta actual del sistema es: " . htmlspecialchars($systemManager->getSystemPath()) . "<br>");
                echo $output; 
                break;
    
            case 'ls-d':
                // El comando 'ls-d' no necesita parámetros
                $systemPaths = $systemManager->listSystemPaths();
                $output = salidaCorrecta('Rutas Del Sistema', "</pre>" .htmlspecialchars(implode("\n", $systemPaths)). "</pre>");
                echo $output; 
                break;
    
            case 'df':
                // El comando 'df' no necesita parámetros
                $systemStatus = $systemManager->getSystemStatus();
                // Formatear la salida con la información del sistema de archivos
                $output = salidaCorrecta(
                    'Estado del Sistema de Archivos',
                    "Tamaño total: " . $systemStatus['total_space'] . "<br>" .
                    "Espacio libre: " . $systemStatus['free_space'] . "<br>" .
                    "Espacio utilizado: " . $systemStatus['used_space']
                );
                
                
            
                // Mostrar el resultado
                echo $output;
                break;
                
    
            case 'searchFile':
                if ($fileManager->searchFile($param)) {
                    $realPath = realpath($param);
                    $padre = dirname($realPath);
                    $output = salidaCorrecta('Buscar Archivo',"El archivo $param existe <br> Ubicado en $padre");
                    echo $output;
                } else {
                    $output = salidaInvalida('Buscar Archivo',"El archivo  $param  no existe.");
                    echo $output;
                }
                break;
            case 'getFileStatus':
                $status = $fileManager->getFileStatus($param);
                if ($status) {
                    // Si el archivo existe, formatear la salida con tamaño y última modificación
                    $output = salidaCorrecta('Estado del Archivo',"Ubicacion: ". $status['location']."<br>Tamaño: " . $status['size'] . " bytes<br>Última modificación: " . $status['modified']);  
                } else {
                    // Si el archivo no existe, mostrar un mensaje de error
                    $output = salidaInvalida('Estado del Archivo',"El archivo no existe.");
                }
                // Mostrar el resultado
                echo $output;
                break;
           

            case 'deleteFile':
                if ($fileManager->deleteFile($param)) {
                    $output = salidaCorrecta('Borrar Archivo',"Archivo $param eliminado correctamente.");
                } else {
                    $output = salidaInvalida('Borrar Archivo',"No se pudo eliminar, el archivo no existe en el direcotrio");
                }
                echo $output;
                break;
            
            case 'moveFile':
                // Separar los parámetros de origen y destino
                $parts = explode(',', $param);
                
                // Verificar que ambos parámetros están presentes
                if (count($parts) < 2) {
                    $output = salidaInvalida('Mover Archivo', "Debes proporcionar tanto el archivo de origen como el archivo de destino.");
                    echo $output;
                    break;
                }
            
                $sourceFile = trim($parts[0]);  // Archivo de origen
                $destinationFile = trim($parts[1]);  // Archivo de destino
            
                // Intentar mover el archivo
                if ($fileManager->moveFile($sourceFile, $destinationFile)) {
                    // Si el movimiento es exitoso
                    $output = salidaCorrecta('Mover Archivo', "Archivo movido de '$sourceFile' a '$destinationFile' correctamente.");
                } else {
                    // Comprobar las posibles causas del fallo
                    if (!file_exists($sourceFile) || !is_file($sourceFile)) {
                        $output = salidaInvalida('Mover Archivo', "El archivo de origen '$sourceFile' no existe o no es válido.");
                    } elseif (file_exists($destinationFile)) {
                        $output = salidaInvalida('Mover Archivo', "El archivo de destino '$destinationFile' ya existe.");
                    } else {
                        $output = salidaInvalida('Mover Archivo', "No se pudo mover el archivo de '$sourceFile' a '$destinationFile'.");
                    }
                }
            
                echo $output;
                break;
                
        

            case 'copyFile':
                // Separar los parámetros de origen y destino
                $parts = explode(',', $param);
            
                // Verificar que ambos parámetros están presentes
                if (count($parts) < 2) {
                    $output = salidaInvalida('Copia de Archivo', "Debes proporcionar tanto el archivo de origen como el archivo de destino.");
                    echo $output;
                    break;
                }
            
                $sourceFile = trim($parts[0]);  // Archivo de origen
                $destinationFile = trim($parts[1]);  // Archivo de destino
            
                // Llamar a la función `copyFile`
                if ($fileManager->copyFile($sourceFile, $destinationFile)) {
                    $output = salidaCorrecta('Copia de Archivo', "Archivo copiado de '$sourceFile' a '$destinationFile' correctamente.");
                } else {
                    // Verificar si el archivo de destino ya existe
                    if (file_exists($destinationFile)) {
                        $output = salidaInvalida('Copia de Archivo', "El archivo de destino '$destinationFile' ya existe.");
                    } else {
                        $output = salidaInvalida('Copia de Archivo', "El archivo de origen '$sourceFile' no existe o no es válido.");
                    }
                }
            
                echo $output;
                break;
                
                
               
            case 'saveFile':
                // Separar los parámetros de archivo y contenido
                $parts = explode(',', $param);
            
                // Verificar que ambos parámetros están presentes
                if (count($parts) < 2) {
                    $output = salidaInvalida('Guardar Archivo', "Debes proporcionar tanto la ruta del archivo como el contenido.");
                    echo $output;
                    break;
                }
            
                $filePath = trim($parts[0]);  // Ruta del archivo
                $newContent = trim($parts[1]);  // Nuevo contenido a guardar
            
                // Llamar a la función saveFile del FileManager
                if ($fileManager->saveFile($filePath, $newContent)) {
                    $output = salidaCorrecta('Guardar Archivo', "Archivo guardado en '$filePath' con el contenido proporcionado.");
                } else {
                    $output = salidaInvalida('Guardar Archivo', "No se pudo guardar el contenido en '$filePath'. Asegúrate de que el archivo exista.");
                }
            
                echo $output;
                break;
                
            case 'copyDirectory':
                // Separar los parámetros de origen y destino
                $parts = explode(',', $param);
                
                // Verificar que ambos parámetros están presentes
                if (count($parts) < 2) {
                    $output = salidaInvalida('Copiar Directorio', "Debes proporcionar tanto el directorio de origen como el de destino.");
                    echo $output;
                    break;
                }
            
                $sourceDirectory = trim($parts[0]);  // Directorio de origen
                $destinationDirectory = trim($parts[1]);  // Directorio de destino
            
                // Validar si los directorios son válidos
                if (!is_dir($sourceDirectory)) {
                    $output = salidaInvalida('Copiar Directorio', "El directorio de origen '$sourceDirectory' no existe o no es válido.");
                    echo $output;
                    break;
                }
                
                if (file_exists($destinationDirectory)) {
                    $output = salidaInvalida('Copiar Directorio', "El directorio de destino '$destinationDirectory' ya existe.");
                    echo $output;
                    break;
                }
            
                // Intentar copiar el directorio
                if ($directoryManager->copyDirectory($sourceDirectory, $destinationDirectory)) {
                    // Si la copia es exitosa
                    $output = salidaCorrecta('Copiar Directorio', "Directorio copiado de '$sourceDirectory' a '$destinationDirectory' correctamente.");
                } else {
                    // Si falla la copia
                    $output = salidaInvalida('Copiar Directorio', "No se pudo copiar el directorio de '$sourceDirectory' a '$destinationDirectory'.");
                }
            
                echo $output;
                break;
            
            case 'moveDirectory':
                // Separar los parámetros de origen y destino
                $parts = explode(',', $param);
                
                // Verificar que ambos parámetros están presentes
                if (count($parts) < 2) {
                    $output = salidaInvalida('Mover Directorio', "Debes proporcionar tanto el directorio de origen como el de destino.");
                    echo $output;
                    break;
                }
            
                $sourceDirectory = trim($parts[0]);  // Directorio de origen
                $destinationDirectory = trim($parts[1]);  // Directorio de destino
            
                // Validar si los directorios son válidos
                if (!is_dir($sourceDirectory)) {
                    $output = salidaInvalida('Mover Directorio', "El directorio de origen '$sourceDirectory' no existe o no es válido.");
                    echo $output;
                    break;
                }
                
                if (file_exists($destinationDirectory)) {
                    $output = salidaInvalida('Mover Directorio', "El directorio de destino '$destinationDirectory' ya existe.");
                    echo $output;
                    break;
                }
            
                // Intentar mover el directorio
                if ($directoryManager->moveDirectory($sourceDirectory, $destinationDirectory)) {
                    // Si el movimiento es exitoso
                    $output = salidaCorrecta('Mover Directorio', "Directorio movido de '$sourceDirectory' a '$destinationDirectory' correctamente.");
                } else {
                    // Si falla el movimiento
                    $output = salidaInvalida('Mover Directorio', "No se pudo mover el directorio de '$sourceDirectory' a '$destinationDirectory'.");
                }
            
                echo $output;
                break;
                    
            
            case 'createDirectory':
                // Verificar si se ha proporcionado el parámetro del directorio
                if (empty($param)) {
                    $output = salidaInvalida('Directorio no creado', "No se proporcionó un directorio válido.");
                    echo $output;
                    break;
                }
                
                $path = trim($param);  // Directorio a crear
                
                // Intentar crear el directorio
                if ($directoryManager->createDirectory($path)) {
                    $output = salidaCorrecta("Directorio creado", 'Directorio "' . htmlspecialchars($path) . '" creado correctamente.');
                } else {
                    // Verificar si el directorio ya existe
                    if (is_dir($path)) {
                        $output = salidaInvalida('Directorio no creado', 'El directorio "' . htmlspecialchars($path) . '" ya existe.');
                    } else {
                        // Si falla por cualquier otro motivo
                        $output = salidaInvalida('Directorio no creado', 'No se pudo crear el directorio "' . htmlspecialchars($path) . '".');
                    }
                }
                echo $output;
                break;

            case 'deleteDirectory':
                // Verificar si se ha proporcionado el parámetro del directorio
                if (empty($param)) {
                    $output = salidaInvalida('No se borro el directorio', "No se proporcionó un directorio válido.");
                    echo $output;
                    break;
                }
            
                $path = trim($param);  // Directorio a eliminar
            
                // Intentar eliminar el directorio
                if ($directoryManager->deleteDirectory($path)) {
                    $output = salidaCorrecta("Directorio borrado", 'Directorio "' . htmlspecialchars($path) . '" eliminado correctamente.');
                } else {
                    // Verificar si el directorio no existe
                    if (!is_dir($path)) {
                        $output = salidaInvalida('No se borro el directorio', 'El directorio "' . htmlspecialchars($path) . '" no existe.');
                    } else {
                        // Si falla por cualquier otro motivo
                        $output = salidaInvalida('No se borro el directorio', 'No se pudo eliminar el directorio "' . htmlspecialchars($path) . '".');
                    }
                }
            
                echo $output;
                break;    
            
            default:
            $output = salidaInvalida('Comando', "Comando '$command' no reconocido.");
            echo $output;
            break;
        }
    }
    

    ?>
    
</body>
</html>