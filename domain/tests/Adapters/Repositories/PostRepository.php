<?php

namespace Domain\Tests\Adapters\Repositories;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Domain\SSN\Posts\Gateway\PostGateway;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class PostRepository implements PostGateway
{
    public function create(Post $post): void
    {
    }

    public function update(Post $post): Post
    {
        return new Post(
            $post->getId(),
            $post->getContent(),
            $post->getAuthor()
        );
    }

    public function getById(UuidInterface $id): Post
    {
        return new Post(
            $id,
            "Content",
            new User(Uuid::uuid4(), "Name", "mail@domain.tld", "password")
        );
    }

    /**
     * @param UuidInterface $id
     * @throws PostNotFoundException
     */
    public function delete(UuidInterface $id): void
    {
        if ($id->equals(Uuid::fromString("df81359a-444d-438f-b429-24e0db62178d"))) {
            throw new PostNotFoundException();
        }
    }
}
