<?php

namespace Domain\SSN\Users\UseCases\FollowUser;

use Ramsey\Uuid\UuidInterface;

class FollowUserRequest
{
    private UuidInterface $id;

    /**
     * FollowUserRequest constructor.
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
