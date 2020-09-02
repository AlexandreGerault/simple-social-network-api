<?php

namespace App\Repositories;

use App\Models\EloquentPost;
use Domain\SSN\Posts\Entity\Post;
use Domain\SSN\Posts\Gateway\PostGateway;

class PostRepository implements PostGateway
{
    public function create(Post $post): void
    {
        EloquentPost::createFromPost($post);
    }
}
