<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../clases/SystemManager.php';

class SystemManagerTest extends TestCase
{
    private $systemManager;

    protected function setUp(): void
    {
        $this->systemManager = new SystemManager();
    }

    public function testListSystemPaths()
    {
        $paths = $this->systemManager->listSystemPaths();

        $this->assertIsArray($paths);
        $this->assertNotEmpty($paths);

        $this->assertContains('/', $paths);
    }

    public function testGetSystemStatus()
    {
        $status = $this->systemManager->getSystemStatus();

        $this->assertIsArray($status);
        $this->assertArrayHasKey('free_space', $status);
        $this->assertArrayHasKey('total_space', $status);
        $this->assertArrayHasKey('used_space', $status);

        $this->assertGreaterThan(0, $status['total_space']);
        $this->assertGreaterThanOrEqual(0, $status['free_space']);
        $this->assertGreaterThanOrEqual(0, $status['used_space']);
    }

    public function testGetSystemPath()
    {
        $currentPath = $this->systemManager->getSystemPath();

        $this->assertIsString($currentPath);
        $this->assertDirectoryExists($currentPath);
    }
}
