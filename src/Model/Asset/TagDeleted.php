<?php

namespace FAPI\Localise\Model\Asset;

use FAPI\Localise\Model\CreatableFromArray;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class TagDeleted implements CreatableFromArray
{
    private $status;

    private $message;

    private function __construct(int $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * @return TagDeleted
     */
    public static function createFromArray(array $data)
    {
        $status = 0;
        $message = '';

        if (isset($data['status'])) {
            $status = $data['status'];
        }

        if (isset($data['message'])) {
            $message = $data['message'];
        }

        return new self($status, $message);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
