<?php
declare(strict_types=1);

namespace App\Request;

/**
 * @package App\Request
 */
interface Lead
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getCategory(): string;

    /**
     * @return array
     */
    public function getExtra(): array;
}
