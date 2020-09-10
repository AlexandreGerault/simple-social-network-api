<?php

namespace App\Repositories;

use App\EloquentUser;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Ramsey\Uuid\UuidInterface;

class UserRepository extends BaseRepository implements UserGateway
{
    protected string $table = 'users';

    /**
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): User
    {
        $dbUser = EloquentUser::where('email', $email)->first();

        if ($dbUser) {
            return EloquentUser::toUser($dbUser);
        }
        throw new UserNotFoundException();
    }

    public function registers(User $user): void
    {
        EloquentUser::createFromUser($user);
    }

    public function getUserById(UuidInterface $id): User
    {
        $dbUser = EloquentUser::find($id->toString());

        return EloquentUser::toUser($dbUser);
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
        $eloquentUsers = EloquentUser::where('email', 'LIKE', "%${search}%")
            ->orWhere('username', 'LIKE', "%${search}%")
            ->get();

        return $eloquentUsers->map(fn ($user) => EloquentUser::toUser($user))->toArray();
    }
}
