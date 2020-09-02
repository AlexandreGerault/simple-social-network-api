<?php

namespace Domain\SSN\Posts\Entity;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostRequest;

class Post
{
    private User $author;
    private string $content;

    /**
     * Post constructor.
     * @param string $content
     * @param User $author
     */
    public function __construct(string $content, User $author)
    {
        $this->content = $content;
        $this->author = $author;
    }

    public static function createFromRequest(CreatePostRequest $request)
    {
        return new self($request->getContent(), $request->getUser());
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
    public function getAuthor(): User
    {
        return $this->author;
    }
}
