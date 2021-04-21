<?php
declare(strict_types=1);

namespace App\Reporter;

/**
 * @package App\Reporter
 */
interface Reporter
{
    /**
     * Handles normal events, but with more important events
     *
     * @param string $message
     * @param array $extra
     */
    public function reportNotice(string $message, array $extra = []): void;


    /**
     * Immediate action should be exercised.
     * This should trigger some alerts and wake you up during night time.
     *
     * @param string $message
     * @param array $extra
     */
    public function reportAlert(string $message, array $extra = []): void;

    /**
     * Detailed debugging information
     *
     * @param string $message
     * @param array $extra
     */
    public function reportDebug(string $message, array $extra = []): void;
}
