<?php
declare(strict_types=1);

namespace App\Impl\Request;

use App\Request\Handler;
use App\Request\Lead;
use App\Storage\Storage;

/**
 * @package App\Impl\Request
 */
class FileHandler implements Handler
{
    private const DELIMITER = ' | ';
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    private const SOME_OPERATION_IMITATION_MICRO_SEC = 20000; // 0.02 sec

    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function processing(Lead $lead): void
    {

        usleep(self::SOME_OPERATION_IMITATION_MICRO_SEC);

        $this->storage->save(
            $lead->getId() . self::DELIMITER .
            $lead->getCategory() . self::DELIMITER .
            date(self::DATE_FORMAT) . self::DELIMITER .PHP_EOL
        );
    }

    public function start(): void
    {
        $this->storage->open();
    }

    public function stop(): void
    {
        $this->storage->close();
    }
}
