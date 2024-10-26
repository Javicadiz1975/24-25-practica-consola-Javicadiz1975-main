<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../clases/DirectoryManager.php';

class DirectoryManagerTest extends TestCase
{
    private $directoryManager;
    private $testDirPath;

    protected function setUp(): void
    {
        $this->directoryManager = new DirectoryManager();
        $this->testDirPath = sys_get_temp_dir() . '/testdir';
    }

    protected function tearDown(): void
    {
        if (is_dir($this->testDirPath)) {
            rmdir($this->testDirPath);
        }
    }

    public function testCreateDirectory()
    {
        $result = $this->directoryManager->createDirectory($this->testDirPath);
        $this->assertTrue($result);
        $this->assertDirectoryExists($this->testDirPath);
    }

    public function testDeleteDirectory()
    {
        mkdir($this->testDirPath); // Crea el directorio antes de eliminarlo
        $result = $this->directoryManager->deleteDirectory($this->testDirPath);
        $this->assertTrue($result);
        $this->assertDirectoryDoesNotExist($this->testDirPath);
    }

    public function testMoveDirectory()
    {
        $newDirPath = sys_get_temp_dir() . '/moveddir';
        mkdir($this->testDirPath); // Crea el directorio antes de moverlo
        $result = $this->directoryManager->moveDirectory($this->testDirPath, $newDirPath);
        $this->assertTrue($result);
        $this->assertDirectoryExists($newDirPath);
        $this->assertDirectoryDoesNotExist($this->testDirPath);
        rmdir($newDirPath); // Limpia el directorio después del test
    }

    public function testCopyDirectory()
    {
        $copyDirPath = sys_get_temp_dir() . '/copydir';
        mkdir($this->testDirPath); // Crea el directorio antes de copiarlo
        $result = $this->directoryManager->copyDirectory($this->testDirPath, $copyDirPath);
        $this->assertTrue($result);
        $this->assertDirectoryExists($copyDirPath);
        $this->assertDirectoryExists($this->testDirPath); // El directorio original debe seguir existiendo
        rmdir($copyDirPath); // Limpia el directorio copiado después del test
    }

}
