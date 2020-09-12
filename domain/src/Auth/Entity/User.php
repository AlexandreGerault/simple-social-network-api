<?php

namespace Domain\SSN\Auth\Entity;

use Domain\SSN\Auth\UseCases\Registration\RegistrationRequest;
use Domain\SSN\Posts\Entity\Post;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;
    private string $username;
    private string $email;
    private string $password;
    /**
     * @var Post[]
     */
    private array $posts;
    /**
     * @var User[]
     */
    private array $followings;

    /**
     * User constructor.
     * @param UuidInterface $id
     * @param string $username
     * @param string $email
     * @param string $password
     * @param Post[] $posts
     * @param User[] $followings
     */
    public function __construct(
        UuidInterface $id,
        string $username,
        string $email,
        string $password,
        array $posts = [],
        array $followings = []
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->posts = $posts;
        $this->followings = $followings;
    }

    public static function createFromRegistration(RegistrationRequest $request)
    {
        return new self(
            Uuid::uuid4(),
            $request->getUsername(),
            $request->getEmail(),
            password_hash($request->getPlainPassword(), PASSWORD_ARGON2ID)
        );
    }

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array|null
     */
    public function getPosts(): ?array
    {
        return $this->posts;
    }

    /**
     * @param Post[] $posts
     * @return $this
     */
    public function addPosts(array $posts): self
    {
        $this->posts = array_merge($posts, $this->posts);

        return $this;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post): self
    {
        $this->posts[] = $post;
        return $this;
    }

    /**
     * @return self[]
     */
    public function getFollowings(): array
    {
        return $this->followings;
    }
}
