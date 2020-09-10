<?php

namespace App\JsonViews\Errors;

use JsonSerializable;

abstract class ErrorJsonView implements JsonSerializable
{
    protected string $title;
    protected string $message;
    protected string $status;
    protected int $httpCode;

    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'status' => $this->status,
            'http_code' => $this->httpCode
        ];
    }
}
