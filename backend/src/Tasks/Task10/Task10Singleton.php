<?php

declare(strict_types=1);

namespace App\Tasks\Task10;

class Task10Singleton
{
    private static ?Task10Singleton $instance = null;

    private ?string $name;

    public static function getInstance() : Task10Singleton
    {
        if (self::$instance === null) {
            self::$instance = new Task10Singleton();
        }

        return self::$instance;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(?string $name) : Task10Singleton
    {
        $this->name = $name;

        return $this;
    }

    private function __construct()
    {
    }

    /**
     *  Prevent cloning of the instance of the Singleton instance.
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserializing of the Singleton instance.
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    // phpcs:ignore
    private function __wakeup() : void
    {
    }
}
