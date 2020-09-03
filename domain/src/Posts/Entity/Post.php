<?php

namespace Domain\SSN\Posts\Entity;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostRequest;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Post
{
    private UuidInterface $id;
    private User $author;
    private string $content;

    /**
     * Post constructor.
     * @param UuidInterface $id
     * @param string $content
     * @param User $author
     */
    public function __construct(UuidInterface $id, string $content, User $author)
    {
        $this->id = $id;
        $this->content = $content;
        $this->author = $author;
    }

    public static function createFromRequest(CreatePostRequest $request)
    {
        return new self(
            Uuid::uuid4(),
            $request->getContent(),
            $request->getUser()
        );
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
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
