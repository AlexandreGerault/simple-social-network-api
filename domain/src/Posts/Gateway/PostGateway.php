<?php

namespace Domain\SSN\Posts\Gateway;

use Domain\SSN\Posts\Entity\Post;
use Ramsey\Uuid\UuidInterface;

interface PostGateway
{
    public function create(Post $post): void;

    public function getById(UuidInterface $id): Post;
    public function update(Post $post): Post;
}
