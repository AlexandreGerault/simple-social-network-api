<?php

namespace Domain\SSN\Posts\UseCases\CreatePost;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Domain\SSN\Auth\Entity\User;

class CreatePostRequest
{
    private ?User $user;
    private string $content;

    /**
     * CreatePostRequest constructor.
     * @param string $content
     * @param User|null $user
     */
    public function __construct(string $content, ?User $user)
    {
        $this->content = $content;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @throws AssertionFailedException
     */
    public function validate(): void
    {
        Assertion::notBlank($this->content);
        Assertion::isInstanceOf($this->user, User::class);
    }
}
