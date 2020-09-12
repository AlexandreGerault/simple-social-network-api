<?php

namespace App\Repositories;

use App\EloquentUser;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Auth\Gateway\UserGateway;
use Ramsey\Uuid\UuidInterface;

class UserRepository extends BaseRepository implements UserGateway, AuthenticationGateway
{
    protected string $table = 'users';

    /**
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): User
    {
        /**
         * @var EloquentUser $dbUser|null
         */
        $dbUser = EloquentUser::query()->where('email', $email)->first();

        if ($dbUser) {
            return EloquentUser::toUser($dbUser);
        }
        throw new UserNotFoundException();
    }

    public function registers(User $user): void
    {
        EloquentUser::createFromUser($user);
    }

    /**
     * @param UuidInterface $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserById(UuidInterface $id): User
    {
        /**
         * @var EloquentUser|null $dbUser
         */
        $dbUser = EloquentUser::query()->find($id->toString());

        if ($dbUser) {
            return EloquentUser::toUser($dbUser);
        }

        throw new UserNotFoundException();
    }

    public function update(User $user): User
    {
        return EloquentUser::updateFromUser($user);
    }

    /**
     * @param string $search
     * @return User[]
     */
    public function search(string $search): array
    {
        $eloquentUsers = EloquentUser::query()->where('email', 'LIKE', "%${search}%")
            ->orWhere('username', 'LIKE', "%${search}%")
            ->get();

        return $eloquentUsers->map(fn ($user) => EloquentUser::toUser($user))->toArray();
    }

    public function getUserByIdAndWithPosts(UuidInterface $id): User
    {
        /**
         * @var EloquentUser $eloquentUser
         */
        $eloquentUser = EloquentUser::with('posts')->where('id', $id->toString())->first();

        return EloquentUser::toUser($eloquentUser);
    }

    public function makeUserFollow(User $authUser, User $userToFollow): User
    {
        /**
         * @var EloquentUser $eloquentUser
         */
        $eloquentUser = EloquentUser::query()
            ->where('id', $authUser->getId()->toString())
            ->first();
        $eloquentUser->followings()->attach($userToFollow->getId()->toString());

        return EloquentUser::toUser($eloquentUser);
    }

    public function getAuthenticatedUser(): User
    {
        return EloquentUser::toUser(auth()->user());
    }
}
