<?php

/**
 * Class SystemManager
 *
 * Esta clase proporciona funcionalidades generales para gestionar el sistema de archivos.
 */
class SystemManager
{
    /**
     * Lista las rutas del sistema de archivos.
     * Devuelve una lista de rutas comunes o directorios que se pueden encontrar en el sistema.
     *
     * @return array Retorna un array con las rutas disponibles en el sistema.
     */
    public function listSystemPaths(){
        $paths = [
            '/usr/bin',
            '/etc',
            '/var',
            '/home',
            '/tmp',
            '/root',
            '/opt',
            '/'
        ];
        // Filtrar solo las rutas que existen en el sistema
        return array_filter($paths, function ($path) {
            return is_dir($path);
        });
    }

    /**
     * Obtiene el estado del sistema de archivos (espacio libre, espacio total y espacio utilizado).
     *
     * @param string $path La ruta del sistema de archivos de la que se desea obtener el estado.
     * @return array|false Retorna un array con las claves 'total_space', 'free_space' y 'used_space', o false si el directorio no es válido.
     */
    public function getSystemStatus($path = '/')
    {
        //TODO: Implementar la lógica
        // Validar si la ruta existe y es un directorio
        if (!is_dir($path)) {
            return false; // Retorna false si no es una ruta válida
        }

        $totalSpace = disk_total_space($path); // Obtiene el tamaño total en bytes
        $freeSpace = disk_free_space($path);   // Obtiene el espacio libre en bytes
        $usedSpace = $totalSpace - $freeSpace; // Calcula el espacio utilizado

        // Convertir los valores de bytes a megabytes
        return [
            'total_space' => round($totalSpace / (1024 * 1024), 2) . ' MB',
            'free_space' => round($freeSpace / (1024 * 1024), 2) . ' MB',
            'used_space' => round($usedSpace / (1024 * 1024), 2) . ' MB'
        ];
    }

    /**
     * Obtiene la ruta actual del sistema donde se está ejecutando el programa.
     *
     * @return string Retorna la ruta del directorio actual de trabajo.
     */
    public function getSystemPath()
    {
        //TODO: Implementar la lógica
        return getcwd(); // Devuelve la ruta actual de trabajo
    }
}
