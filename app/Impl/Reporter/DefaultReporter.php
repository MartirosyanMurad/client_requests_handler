<?php

namespace App\Impl\Reporter;

use App\Reporter\Reporter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class DefaultReporter implements Reporter
{
    private Logger $monolog;
    /**
     * @var string[]
     */
    private array $notices = [];
    /**
     * @var string[]
     */
    private array $alerts = [];
    /**
     * @var array
     */
    private array $extras = [];

    public function __construct()
    {
        $this->monolog = new Logger('default');
        $this->monolog->pushHandler(new StreamHandler(STDOUT));
    }

    public function reportNotice(string $message, array $extra = []): void
    {
        $this->monolog->notice($message, $extra);
    }


    public function reportAlert(string $message, array $extra = []): void
    {
        $this->monolog->alert($message, $extra);
    }


    public function reportDebug(string $message, array $extra = []): void
    {
        $this->monolog->debug($message, $extra);
    }
}
