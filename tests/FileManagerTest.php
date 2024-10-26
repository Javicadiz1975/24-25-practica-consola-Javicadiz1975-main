<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../clases/FileManager.php';

class FileManagerTest extends TestCase
{
    private $fileManager;
    private $testFilePath;
    private $testFileContent;

    protected function setUp(): void
    {
        $this->fileManager = new FileManager();
        $this->testFilePath = sys_get_temp_dir() . '/testfile.txt';
        $this->testFileContent = "Contenido de prueba";
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }

    public function testDeleteFile()
    {
        file_put_contents($this->testFilePath, $this->testFileContent); // Crea el archivo antes de eliminarlo
        $result = $this->fileManager->deleteFile($this->testFilePath);
        $this->assertTrue($result);
        $this->assertFileDoesNotExist($this->testFilePath);
    }

    public function testMoveFile()
    {
        $newFilePath = sys_get_temp_dir() . '/movedfile.txt';
        $this->fileManager->saveFile($this->testFilePath, $this->testFileContent);
        $result = $this->fileManager->moveFile($this->testFilePath, $newFilePath);
        $this->assertTrue($result);
        $this->assertFileExists($newFilePath);
        $this->assertFileDoesNotExist($this->testFilePath);
        unlink($newFilePath); // Eliminar el archivo movido después del test
    }
    
    public function testCopyFile()
    {
        $copyFilePath = sys_get_temp_dir() . '/copyfile.txt';
        $this->fileManager->saveFile($this->testFilePath, $this->testFileContent);
        $result = $this->fileManager->copyFile($this->testFilePath, $copyFilePath);
        $this->assertTrue($result);
        $this->assertFileExists($copyFilePath);
        $this->assertEquals($this->testFileContent, file_get_contents($copyFilePath));
        unlink($copyFilePath); // Eliminar el archivo copiado después del test
    }

    public function testSearchFile()
    {
        $this->fileManager->saveFile($this->testFilePath, $this->testFileContent);
        $result = $this->fileManager->searchFile($this->testFilePath);
        $this->assertTrue($result);
    }

    public function testGetFileStatus()
    {
        $this->fileManager->saveFile($this->testFilePath, $this->testFileContent);
        $status = $this->fileManager->getFileStatus($this->testFilePath);

        $this->assertIsArray($status);
        $this->assertArrayHasKey('size', $status);
        $this->assertArrayHasKey('modified', $status);

        $this->assertEquals(strlen($this->testFileContent), $status['size']);
    }

    public function testSaveFileCreatesFile()
    {
        // Probar la creación de un archivo
        $content = "Contenido inicial";
        $result = $this->fileManager->saveFile($this->testFilePath, $content);
        $this->assertTrue($result, 'El archivo debería crearse correctamente.');
        $this->assertFileExists($this->testFilePath, 'El archivo debería existir.');
        $this->assertEquals($content, file_get_contents($this->testFilePath), 'El contenido del archivo debería ser correcto.');
    }

    public function testSaveFileModifiesFile()
    {
        // Crear un archivo antes de modificarlo
        file_put_contents($this->testFilePath, 'Contenido viejo');

        // Probar la modificación del archivo
        $newContent = "Nuevo contenido";
        $result = $this->fileManager->saveFile($this->testFilePath, $newContent);
        $this->assertTrue($result, 'El archivo debería modificarse correctamente.');
        $this->assertFileExists($this->testFilePath, 'El archivo debería existir.');
        $this->assertEquals($newContent, file_get_contents($this->testFilePath), 'El contenido del archivo debería haberse modificado.');
    }
}
