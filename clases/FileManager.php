<?php

/**
 * Class FileManager
 *
 * Esta clase proporciona funcionalidades para gestionar archivos.
 */
class FileManager {

    /**
     * Obtiene el estado de un archivo (tamaño, fecha de modificación, etc.).
     *
     * @param string $filePath La ruta del archivo.
     * @return array Retorna un array asociativo (con índices size y modified) con información del archivo o false si el archivo no existe.
     */
    public function getFileStatus($filePath) {
        //TODO: Implementar la lógica
        if (file_exists($filePath)) {
            return [
                'size' => filesize($filePath), // Tamaño del archivo
                'modified' => date("F d Y H:i:s.", filemtime($filePath)), // Fecha de última modificación
                'location' => realpath($filePath)
            ];

        }
        return false; // Retorna false si el archivo no existe
    }

    /**
     * Elimina un archivo.
     *
     * @param string $filePath La ruta del archivo a eliminar.
     * @return bool Retorna true si el archivo se elimina correctamente, false en caso contrario.
     */
    public function deleteFile($filePath)
    {
        //TODO: Implementar la lógica
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath); // Elimina el archivo
        }
        return false; // Retorna false si el archivo no existe
    }

    /**
     * Mueve un archivo a una nueva ubicación.
     *
     * @param string $sourcePath La ruta del archivo de origen.
     * @param string $destinationPath La nueva ruta de destino.
     * @return bool Retorna true si el archivo se mueve correctamente, false en caso contrario.
     */
    public function moveFile($sourcePath, $destinationPath) {
        // Verificar si el archivo de origen existe y es un archivo válido
        if (!file_exists($sourcePath) || !is_file($sourcePath)) {
            return false; // El archivo de origen no existe o no es válido
        }
    
        // Verificar si el archivo o directorio de destino ya existe
        if (file_exists($destinationPath)) {
            // Mostrar un mensaje o manejar el caso en que ya exista el archivo de destino
            return false;
        }
    
        // Intentar mover el archivo a la nueva ubicación
        return rename($sourcePath, $destinationPath); // Retorna true si se mueve correctamente, false en caso contrario
    }

    /**
     * Copia un archivo a una nueva ubicación.
     *
     * @param string $sourcePath La ruta del archivo de origen.
     * @param string $destinationPath La nueva ruta de destino.
     * @return bool Retorna true si el archivo se copia correctamente, false en caso contrario.
     */
    
     public function copyFile($sourcePath, $destinationPath) {
        // Verificar si el archivo de origen existe y es un archivo válido
        if (!file_exists($sourcePath) || !is_file($sourcePath)) {
            return false; // El archivo de origen no existe o no es válido
        }
    
        // Verificar si el archivo de destino ya existe
        if (file_exists($destinationPath)) {
            return false; // El archivo de destino ya existe
        }
    
        // Intentar copiar el archivo
        return copy($sourcePath, $destinationPath); // Retorna true si la copia fue exitosa, false en caso contrario
    }
    
    

    /**
     * Busca un archivo dentro del sistema.
     *
     * @param string $filePath La ruta completa del archivo a buscar.
     * @return bool Retorna true si el archivo existe, false en caso contrario.
     */
    public function searchFile($filePath)
    {
        //TODO: Implementar la lógica
        return file_exists($filePath); // Retorna true si el archivo existe, false en caso contrario
    }

    /*
     * Guarda nuevo contenido en un archivo existente.
     *
     * Si el archivo ya existe, sobrescribe su contenido con el nuevo contenido proporcionado.
     *
     * @param string $filePath La ruta completa del archivo donde se va a guardar el nuevo contenido.
     * @param string $newContent El contenido que se va a guardar en el archivo.
     * @return bool Retorna true si el contenido se guarda correctamente, false si el archivo no existe o si no se puede guardar.
     */
    public function saveFile($filePath, $newContent) {
        // Intentar escribir el contenido en el archivo (crea el archivo si no existe)
        return file_put_contents($filePath, $newContent) !== false;
    }
    
}
