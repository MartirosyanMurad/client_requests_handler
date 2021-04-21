<?php
declare(strict_types=1);

namespace App;

use App\Impl\Request\GenLead;
use App\Reporter\Reporter;
use App\Request\Handler;
use Exception;
use LeadGenerator\Generator;
use LeadGenerator\Lead;

/**
 * @package App
 */
class Process
{
    private const CATEGORY_BUT_AUTO = 'Buy auto';
    private const CATEGORY_GET_LOAN = 'Get loan';
    private const CATEGORY_PIZZA = 'Pizza';

    private const NOT_PROCESSED_CATEGORY = [
        self::CATEGORY_BUT_AUTO,
        self::CATEGORY_GET_LOAN,
        self::CATEGORY_PIZZA,
    ];

    private Generator $generator;
    private Reporter $reporter;
    private Handler $handler;
    private int $leadCount;
    private bool $run = true;

    /**
     * Process constructor.
     *
     * @param Generator $generator
     * @param Reporter  $reporter
     * @param Handler   $handler
     * @param int       $leadCount
     */
    public function __construct(
        Generator $generator,
        Reporter $reporter,
        Handler $handler,
        int $leadCount
    ) {
        $this->generator = $generator;
        $this->reporter = $reporter;
        $this->handler = $handler;
        $this->leadCount = $leadCount;
        $this->handleSignal();
    }

    public function run(): void
    {
        while ($this->run) {
            usleep(SLEEP_BEFORE_START_PROCESS_MICRO_SECOND);
            $start = microtime(true);

            $this->handler->start();
            $this->generator->generateLeads($this->leadCount, function (Lead $lead) {
                if (in_array($lead->categoryName, self::NOT_PROCESSED_CATEGORY, true)) {
                    $this->reporter->reportNotice("Can`t processed lead {$lead->id} for category {$lead->categoryName}");
                    return;
                }

                $genLead = new GenLead($lead->id, $lead->categoryName);

                try {
                    $this->handler->processing($genLead);
                    $this->reporter->reportDebug("Success processed lead {$lead->id} for category $lead->categoryName");
                } catch (Exception $e) {
                    $this->reporter->reportAlert(
                        "Get exception while processed lead {$lead->id} for category $lead->categoryName\n
                        Exception: --message {$e->getMessage()} --code {$e->getCode()} --trace {$e->getTraceAsString()}"
                    );
                }
            });
            $this->handler->stop();

            $processTime = microtime(true) - $start;
            $this->reporter->reportDebug("Time: $processTime");

            usleep(SLEEP_AFTER_START_PROCESS_MICRO_SECOND);
        }
    }

    public function stopProcess(): void
    {
        $this->reporter->reportDebug("Start terminations...");
        $this->run = false;
    }

    private function handleSignal(): void
    {
        pcntl_async_signals(true);
        pcntl_signal(SIGTERM, [$this, 'stopProcess']);
    }
}