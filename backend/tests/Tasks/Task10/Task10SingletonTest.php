<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task10;

use App\Tasks\Task10\Task10Singleton;
use Error;
use PHPUnit\Framework\TestCase;

class Task10SingletonTest extends TestCase
{
    private Task10Singleton $singleton;

    protected function setUp() : void
    {
        $this->singleton = Task10Singleton::getInstance();
    }

    /**
     * @dataProvider setNameProvider
     */
    public function testSetName(string $expectedName) : void
    {
        $this->singleton->setName($expectedName);
        $this->assertEquals($expectedName, $this->singleton->getName());
    }

    public function testNewInstance() : void
    {
        $this->expectException(Error::class);
        /* @phpstan-ignore-next-line */
        new Task10Singleton();
    }

    public function testClone() : void
    {
        $this->expectException(Error::class);
        $another = clone $this->singleton;
    }

    /**
     * @return array<mixed>
     */
    public function setNameProvider() : array
    {
        return [
            ['some-name'],
            ['some-name 2'],
        ];
    }
}
