<?php

namespace App\Repositories;

use App\EloquentUser;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Ramsey\Uuid\Uuid;
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
            return new User(
                Uuid::fromString($dbUser->id),
                $dbUser->username,
                $dbUser->email,
                $dbUser->password
            );
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

        return new User(
            Uuid::fromString($dbUser->id),
            $dbUser->username,
            $dbUser->email,
            $dbUser->password
        );
    }

    public function update(User $user): User
    {
        return EloquentUser::updateFromUser($user);
    }
}
