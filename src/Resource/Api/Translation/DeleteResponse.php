<?php

namespace APIPHP\Localise\Resource\Api\Translation;

use APIPHP\Localise\Resource\ApiResponse;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class DeleteResponse implements ApiResponse
{
    private $status;
    private $message;

    /**
     * @param int    $status
     * @param string $message
     */
    private function __construct(int $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * @param array $data
     *
     * @return DeleteResponse
     */
    public static function create(array $data)
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

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
