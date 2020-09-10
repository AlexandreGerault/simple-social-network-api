<?php

namespace Domain\SSN\Users\UseCases\SearchUser;

use Assert\Assertion;
use Assert\AssertionFailedException;

class SearchUserRequest
{
    private string $search;

    /**
     * SearchUserRequest constructor.
     * @param string $search
     */
    public function __construct(string $search)
    {
        $this->search = $search;
    }

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * @throws AssertionFailedException
     */
    public function validate(): void
    {
        Assertion::notBlank($this->search);
    }
}
