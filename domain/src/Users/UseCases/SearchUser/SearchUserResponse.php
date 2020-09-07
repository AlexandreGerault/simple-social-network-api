<?php

namespace Domain\SSN\Users\UseCases\SearchUser;

class SearchUserResponse
{
    private array $results;

    /**
     * SearchUserResponse constructor.
     * @param array $results
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
