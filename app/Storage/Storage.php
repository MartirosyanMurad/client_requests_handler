<?php
declare(strict_types=1);

namespace App\Storage;

/**
 * @package App\Storage
 */
interface Storage
{
    /**
     * @param string $mode
     */
    public function open(string $mode): void;

    public function close(): void;

    /**
     * @param string $data
     */
    public function save(string $data): void;
}
