<?php

namespace Domain\SSN\Posts\Gateway;

use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Ramsey\Uuid\UuidInterface;

interface PostGateway
{
    public function create(Post $post): void;

    /**
     * @param UuidInterface $id
     * @return Post
     * @throws PostNotFoundException
     */
    public function getById(UuidInterface $id): Post;
    public function update(Post $post): Post;
}
