<?php

namespace Domain\SSN\Auth\Gateway;

use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Ramsey\Uuid\UuidInterface;

interface UserGateway
{
    /**
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): User;

    /**
     * @param UuidInterface $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserById(UuidInterface $id): User;

    /**
     * @param UuidInterface $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByIdAndWithPosts(UuidInterface $id): User;

    public function registers(User $user): void;

    public function update(User $user): User;

    /**
     * @param string $search
     * @return User[]
     */
    public function search(string $search): array;

    /**
     * @param User $authUser
     * @param User $userToFollow
     * @return User
     */
    public function makeUserFollow(User $authUser, User $userToFollow): User;

    public function makeUserUnfollow(User $authUser, User $userToFollow): User;
}
