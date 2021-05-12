<?php
declare(strict_types=1);

namespace App\Storage;

/**
 * @package App\Storage
 */
interface Storage
{
    /**
     * @param string $data
     */
    public function save(string $data): void;
}
