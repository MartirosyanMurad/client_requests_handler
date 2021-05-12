<?php
declare(strict_types=1);

namespace App\Impl\Storage;

use App\Storage\Storage;

/**
 * Class FileStorage
 */
class FileStorage implements Storage
{
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
    public function save(string $data): void
    {
        file_put_contents($this->fileDir, $data, FILE_APPEND);
    }
}
