<?php
declare(strict_types=1);

namespace App\Request;

/**
 * @package App\Request
 */
interface Handler
{
    /**
     * @param Lead $lead
     */
    public function processing(Lead $lead): void;
}
