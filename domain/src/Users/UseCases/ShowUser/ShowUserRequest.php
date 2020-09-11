<?php

namespace Domain\SSN\Users\UseCases\ShowUser;

use Ramsey\Uuid\UuidInterface;

class ShowUserRequest
{
    private UuidInterface $id;

    /**
     * ShowUserRequest constructor.
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
