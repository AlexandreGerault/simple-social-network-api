<?php

namespace App\Repositories;

use App\EloquentUser;
use App\Models\EloquentPost;
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
                EloquentUser::toUser($eloquentPost->author)
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
            EloquentUser::toUser($eloquentPost->author)
        );
    }

    public function delete(UuidInterface $id): void
    {
        if (!EloquentPost::destroy($id->toString())) {
            throw new PostNotFoundException();
        }
    }
}
