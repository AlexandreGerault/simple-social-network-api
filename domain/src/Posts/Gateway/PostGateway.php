<?php

namespace Domain\SSN\Posts\Gateway;

use Domain\SSN\Posts\Entity\Post;

interface PostGateway
{
    public function create(Post $post): void;
}
