<?php
declare(strict_types=1);

namespace App\Impl\Storage;

use App\Storage\Storage;

/**
 * Class FileStorage
 */
class FileStorage implements Storage
{
    private const SAFE_WRITE_MODE = 'wb+';

    private string $fileDir;

    /** @var false|resource */
    private $storage;

    /**
     * FileStorage constructor.
     *
     * @param string $fileDir
     */
    public function __construct(string $fileDir)
    {
        $this->fileDir = $fileDir;
    }

    /**
     * @inheritdoc
     */
    public function open(string $mode = self::SAFE_WRITE_MODE): void
    {
        $this->storage = fopen($this->fileDir, $mode);
    }

    public function close(): void
    {
        fclose($this->storage);
    }

    /**
     * @inheritdoc
     */
    public function save(string $data): void
    {
        fwrite($this->storage, $data);
    }
}
