<?php
declare(strict_types=1);

namespace App\Impl\Request;

use App\Request\Lead;

/**
 * @package App\Impl\Request
 */
class GenLead implements Lead
{
    private int $id;
    private string $category;
    private array $extra;

    /**
     * GenLead constructor.
     *
     * @param int    $id
     * @param string $category
     * @param array  $extra
     */
    public function __construct(int $id, string $category, array $extra = [])
    {
        $this->id = $id;
        $this->category = $category;
        $this->extra = $extra;
    }

    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @inheritdoc
     */
    public function getExtra(): array
    {
        return $this->extra;
    }
}
