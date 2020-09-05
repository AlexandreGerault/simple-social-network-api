<?php

namespace App\Repositories;

use App\Models\EloquentPost;
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
        EloquentPost::createFromPost($post);
    }

    /**
     * @param UuidInterface $id
     * @return Post
     * @throws PostNotFoundException
     */
    public function getById(UuidInterface $id): Post
    {
        $eloquentPost = EloquentPost::find($id);
        if ($eloquentPost) {
            return new Post(
                Uuid::fromString($eloquentPost->id),
                $eloquentPost->content,
                new User(
                    Uuid::fromString($eloquentPost->author->id),
                    $eloquentPost->author->username,
                    $eloquentPost->author->email,
                    $eloquentPost->author->password
                )
            );
        }

        throw new PostNotFoundException();
    }

    /**
     * @param Post $post
     * @return Post
     * @throws PostNotFoundException
     */
    public function update(Post $post): Post
    {
        if (!$eloquentPost = EloquentPost::find($post->getId())) {
            throw new PostNotFoundException();
        }
        $eloquentPost->content = $post->getContent();
        $eloquentPost->save();

        return new Post(
            Uuid::fromString($eloquentPost->id),
            $eloquentPost->content,
            new User(
                Uuid::fromString($eloquentPost->author->id),
                $eloquentPost->author->username,
                $eloquentPost->author->email,
                $eloquentPost->author->password
            )
        );
    }
}
