<?php

namespace Domain\SSN\Users\UseCases\UnfollowUser;

use Ramsey\Uuid\UuidInterface;

class UnfollowUserRequest
{
    private UuidInterface $id;

    /**
     * UnfollowUserRequest constructor.
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
