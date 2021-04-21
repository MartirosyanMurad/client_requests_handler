<?php
declare(strict_types=1);

namespace App\Request;

/**
 * @package App\Request
 */
interface Handler
{
    public function start(): void;

    public function processing(Lead $lead): void;

    public function stop(): void;
}
