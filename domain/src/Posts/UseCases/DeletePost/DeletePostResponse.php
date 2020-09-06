<?php

namespace Domain\SSN\Posts\UseCases\DeletePost;

class DeletePostResponse
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
