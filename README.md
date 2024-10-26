# Proyecto de Aplicación Consola de Comandos

Este proyecto proporciona un conjunto de herramientas para gestionar directorios, archivos y obtener información sobre el sistema de archivos. La funcionalidad se divide en tres partes principales: **gestión de directorios**, **gestión de archivos** y **gestión del sistema**.


## Estructura y descripción de los Archivos Principales

- **DirectoryManager.php**: Proporciona funcionalidades para la creación, eliminación, movimiento, copia y búsqueda de archivos dentro de directorios.
- **FileManager.php**: Ofrece operaciones para la gestión de archivos, como la creación, eliminación, movimiento, copia y modificación del contenido de un archivo.
- **SystemManager.php**: Proporciona funcionalidades para obtener información general del sistema de archivos, como el espacio disponible y las rutas del sistema.
- **index.php**: Este archivo se utiliza para recibir solicitudes HTTP desde el frontend y devolver respuestas basadas en las operaciones del backend.
- **projectController.php**: Este archivo recibe las solicitudes y controlará la llamada de una función u otra según la petición del usuario.
- **tests/**: Contiene pruebas unitarias que garantizan la validación del código [NO TOCAR].


## Instalación

1. Clona el repositorio dentro de tu carpeta htdocs.
   ```bash
   git clone <ver enlace del repositorio en Sallenet>
