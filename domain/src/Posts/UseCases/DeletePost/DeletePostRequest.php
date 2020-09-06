<?php

namespace Domain\SSN\Posts\UseCases\DeletePost;

use Ramsey\Uuid\UuidInterface;

class DeletePostRequest
{
    private UuidInterface $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
