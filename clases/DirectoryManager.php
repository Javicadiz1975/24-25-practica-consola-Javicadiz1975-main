<?php

/**
 * Class DirectoryManager
 *
 * Esta clase proporciona funcionalidades para gestionar directorios.
 */
class DirectoryManager {

    /**
     * Crea un directorio.
     *
     * @param string $path La ruta del directorio a crear.
     * @return bool Retorna true si el directorio se crea correctamente, false en caso contrario.
     */
    public function createDirectory($path)
{
    // Verificar si el directorio ya existe
    if (is_dir($path)) {
        return false; // Retorna false si el directorio ya existe
    }

    // Intentar crear el directorio
    if (mkdir($path, 0777, true)) {
        return true; // Retorna true si se creó correctamente
    }

    // Retornar false si falla la creación del directorio
    return false;
}

    /**
     * Elimina un directorio y su contenido.
     *
     * @param string $path La ruta del directorio a eliminar.
     * @return bool Retorna true si el directorio se elimina correctamente, false en caso contrario.
     */
    public function deleteDirectory($path)
    {
        //TODO: Implementar la lógica
        if (is_dir($path)) {
            return $this->deleteDirectoryRecursively($path);
        }
        return false; // Retorna false si el directorio no existe
    }

    /**
     * Función auxiliar para eliminar directorios de forma recursiva.
     *
     * @param string $path La ruta del directorio a eliminar.
     */
    private function deleteDirectoryRecursively($path)
    {
        //TODO: Implementar la lógica
        $files = array_diff(scandir($path), ['.', '..']); // Filtra los archivos y carpetas
        foreach ($files as $file) {
            $filePath = "$path/$file";
            if (is_dir($filePath)) {
                $this->deleteDirectoryRecursively($filePath); // Elimina directorios de forma recursiva
            } else {
                unlink($filePath); // Elimina archivos
            }
        }
        return rmdir($path); // Elimina el directorio principal
    }

    /**
     * Mueve un directorio a una nueva ubicación.
     *
     * @param string $sourcePath La ruta del directorio de origen.
     * @param string $destinationPath La nueva ruta de destino.
     * @return bool Retorna true si el directorio se mueve correctamente, false en caso contrario.
     */
    public function moveDirectory($sourcePath, $destinationPath)
    {
        //TODO: Implementar la lógica
        if (is_dir($sourcePath) && !file_exists($destinationPath)) {
            return rename($sourcePath, $destinationPath); // Mueve el directorio a la nueva ruta
        }
        return false; // Retorna false si el directorio de origen no existe o el de destino ya existe
    }

    /**
     * Copia un directorio a una nueva ubicación.
     *
     * @param string $sourcePath La ruta del directorio de origen.
     * @param string $destinationPath La nueva ruta de destino.
     * @return bool Retorna true si el directorio se copia correctamente, false en caso contrario.
     */
    public function copyDirectory($sourcePath, $destinationPath){
    // Verificar si el directorio de origen existe y el destino no existe aún
        if (!is_dir($sourcePath) || file_exists($destinationPath)) {
            return false; // Retorna false si el directorio de origen no existe o el de destino ya existe
        }

        // Crear el directorio de destino
        if (!mkdir($destinationPath, 0777, true)) {
            return false; // Si no se pudo crear el directorio de destino, retornar false
        }

        // Obtener los archivos del directorio de origen, omitiendo '.' y '..'
        $files = array_diff(scandir($sourcePath), ['.', '..']);

        // Iterar sobre los archivos/directorios en el directorio de origen
        foreach ($files as $file) {
            $src = "$sourcePath/$file"; // Ruta del archivo/directorio en el origen
            $dst = "$destinationPath/$file"; // Ruta del archivo/directorio en el destino

            // Si es un directorio, hacer copia recursiva
            if (is_dir($src)) {
                if (!$this->copyDirectory($src, $dst)) {
                    return false; // Si la copia recursiva falla, retornar false
                }
            } else {
                // Si es un archivo, copiarlo
                if (!copy($src, $dst)) {
                    return false; // Si no se puede copiar el archivo, retornar false
                }
            }
    }

    return true; // Retornar true si todo fue copiado correctamente
}

}
