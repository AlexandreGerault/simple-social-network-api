<?php

namespace Domain\SSN\Users\UseCases\SearchUser;

use Domain\SSN\Auth\Entity\User;

class SearchUserResponse
{
    /**
     * @var User[] $results;
     */
    private array $results;

    /**
     * SearchUserResponse constructor.
     * @param User[] $results
     */
    public function __construct(array $results)
    {
        $this->results = $results;
    }

    public function getResults(): array
    {
        return $this->results;
    }
}
